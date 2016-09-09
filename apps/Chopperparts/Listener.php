<?php
namespace Chopperparts;

class Listener  extends \Prefab
{
    public function onSystemRegisterEmails($event)
    {
        if (class_exists('\Mailer\Factory'))
        {
    
            $model = (new \Mailer\Models\Events);
    
            \Mailer\Models\Events::register('chopperparts.contact_us',
                [
                    'title' => 'Submitted Contact Us',
                    'copy' => 'Asks a customer to review the products in their order',
                    'app' => 'System',
                ],
                [
                    'event_subject' => 'Contact Us Submitted',
                    'event_html' => ' ',
                    'event_text' => ' '
                ]
                );
        
            \Dsc\System::instance()->addMessage('Tashaschuh added its emails.');
        }
    }
    
    /**
     * Triggered when valid shipping method options are fetched for a cart
     *
     * @param unknown $event
     */
    public function onFetchShippingMethodsForCart($event)
    {
        $cart = $event->getArgument('cart');
    

        $this->standardShippingMethods($event);
        
    }
    
    
    // Fire a beforeShopCheckout event that allows Listeners to hijack the checkout process
    // Payment processing & authorization could occur at this event, and the Listener would update the checkout object
    // Add the checkout model to the event
    public function beforeShopCheckout($event)
    {
        
        
        
        $checkout = $event->getArgument('checkout');
        
       $paymentData =  $checkout->paymentData();
       
       if(empty($paymentData['payment_method_nonce'])) {
           //if empty cart->nonce is empty fo paypal? one as well
           $checkout->setError('Payment Method is Invalid');
       } else {
           $nonce = $paymentData['payment_method_nonce'];
       }
        
      
        $cart = \Shop\Models\Carts::fetch();
        /*
         * HANDLE GUEST CHECKOUT IF THIS IS A GUEST CHECKOUT WE NEED TO HANDLE THIS
         */
        $identity = \Dsc\System::instance()->get('auth')->getIdentity();
        
        
        if (empty( $identity->id ))
        {
            
            if (!filter_var($cart->user_email, FILTER_VALIDATE_EMAIL)) {
                \Dsc\System::addMessage( 'Please enter a valid email address.', 'error' );
                \Base::instance()->reroute( '/shop/checkout' );
                return;
            }
        
            if (\Users\Models\Users::emailExists($cart->user_email)) {
                //IF the email exists in mongo but the customer didn't login we will load them add assign this user to cart just before accept
                $identity = (new \Users\Models\Users)->load(['email' => $cart->user_email]);
                $assignToUnAuthenticatedGuest  = true;
                $cart->set('user_id', $identity->id)->store();
            } else {
        
                //THIS IS A NEW EMAIL LETS MAKE A GUEST USER
        
                $mongo_id = (string) new \MongoId;
                $password = \Users\Models\Users::generateRandomString();
                $name =  $checkout_inputs['billing_address']['name'];
                $name = $this->parseName($name);
        
                $data = array(
                    'first_name' => $name['first'],
                    'last_name' => $name['last'],
                    'email' => $cart->user_email,
                    'new_password' => $password,
                    'confirm_new_password' => $password
                );
        
                $identity = (new \Users\Models\Users)->bind($data);
               
                try
                {
                    // this will handle other validations, such as username uniqueness, etc
                    $identity->set('role', 'identified');
                    $identity->set('active', true);
                    $identity->save();
                }
                catch(\Exception $e)
                {
                    \Shop\Models\CheckoutGoals::completedPaymentFailed($e->getMessage(), false);
                    \Dsc\System::addMessage( 'Could not create guest account', 'error' );
                    \Dsc\System::addMessage( $e->getMessage(), 'error' );
                    \Dsc\System::instance()->setUserState('shop.checkout.register.flash_filled', true);
                    $flash = \Dsc\Flash::instance();
                    $flash->store(array());
                    \Base::instance()->reroute('/shop/checkout');
                    return;
                }
        
                // if we have reached here, then all is right with the form
                $flash = \Dsc\Flash::instance();
                $flash->store(array());
        
                $cart->set('user_id', $identity->id)->store();
        
                \Shop\Models\Customers::sendNewCustomerEmail($identity->id);
        
            }
           
            /*
             * BEFORE WE CAN CHECKOUT WITH BRAINTREE WE NEED TO HAVE A BRAINTREE CUSTOMER SO LETS CHECK TO SEE IF WE HAVE ONE AND IF SO LOAD IT SO WE CAN
             */
            if(!empty($identity->get('braintree.id'))) {
                
                $braintreeCustomerID = $identity->get('braintree.id');
            
                //OK THIS USER HAS A PREVIOUS ACCOUNT LETS LOAD IT TO CONFIRM IT IS VALID
                try {
                    $braintree_customer = \Braintree_Customer::find($braintreeCustomerID);
                    $cart->set('__braintree_customer', $braintree_customer);
                } catch (\Braintree_Exception_NotFound $e) {
                    //lets generate one of the user, a listener should have already handled this before getting here but this is a catch all
                    $user = \Shop\Payment\Braintree::createCustomerQueue($identity->id);
                    $braintreeCustomerID = $user->get('braintree.id');
                    $braintree_customer = \Braintree_Customer::find($braintreeCustomerID);
                    $cart->set('__braintree_customer', $braintree_customer);
                } catch (\Exception $e) {
            
                    
                                
                    \Dsc\System::addMessage( $e->getMessage(), 'error' );
                    \Base::instance()->reroute('/shop/checkout');
            
                }
            
            } else {
       
                //create a customer for new customer and guests
                $user = \Shop\Payment\Braintree::createCustomerQueue($identity->id);
               
                $braintreeCustomerID = $user->get('braintree.id');
                $braintree_customer = \Braintree_Customer::find($braintreeCustomerID);
                $cart->set('__braintree_customer', $braintree_customer);
            
            }
            
            
            $billingAddress = array();
            $billingAddress['streetAddress'] =  $cart->get('checkout.billing_address.line_1');
            if(!empty( $cart->get('checkout.billing_address.line_2'))) {
                $billingAddress['extendedAddress'] =  $cart->get('checkout.billing_address.line_2');
            }
            if(!empty($cart->get('checkout.billing_address.city'))) {
                $billingAddress['locality'] =  $cart->get('checkout.billing_address.city');
            }
            if(!empty($cart->get('checkout.billing_address.region'))) {
                $billingAddress['region'] = $cart->get('checkout.billing_address.region');
            }
            
            if (!empty($cart->get('checkout.billing_address.postal_code'))) {
                $billingAddress['postalCode'] = $cart->get('checkout.billing_address.postal_code');
            }
            
            $billingAddress['countryCodeAlpha2'] = $cart->get('checkout.billing_address.country');
            
            
           
            
            $braintree = new \Shop\Payment\Braintree;
            
           
            /*
             * CREATE A TOKEN FOR THIS CARD THEY JUST SUBMITTED
             */
            try {
            
                //'deviceData' => @$data['device_data']
                $paymentData = $braintree->getTokenFromNonce($nonce,$cart->get('__braintree_customer')->id, ['billing' => $billingAddress ]);
            
                //IF WE ARE USING PAYPAL
                if(!empty($cart->get('nonce'))) {
                    $cart->set('payment_data', $paymentData)->store();
                }
            
            
                $checkout->addPaymentData($paymentData);
            
            
                if(!empty($assignToUnAuthenticatedGuest)) {
                    $cart->set('user_id', $identity->id);
                }
            
                /*
                 * ACCEPT PAYMENT UP HERE SO THAT IT CAN TRIGGER CHECKOUT ERRORS
                 */
                $checkout->acceptOrder();
            
            
              
            }  catch (\Exception $e) {
            
                switch ( $e->getCode()) {
                    //CUSTOM BRAINTREE TOKEN REPORTED FRAUD
                    case 'K501':
                        
                        $checkout->setError($e->getMessage());
                        break;
            
                    default:
                        $checkout->setError($e->getMessage());
                        break;
                }
            
            
            }
            
            
            
            
            $event->setArgument('checkout', $checkout);
            
        
        }
        
        
        
        
    
    }
    
    /**
     * Set the shipping methods for a cart when the user is not a wholesaler
     *
     * Include the corresponding Netsuite ID number for each of these shipping methods --
     * see Lists >> Accounting >> Shipping Items in the NS Interface
     *
     * @param unknown $event
     */
    private function standardShippingMethods(&$event)
    {
        $cart = $event->getArgument('cart');
        $methods = $event->getArgument('methods');
    
        $item_surcharges = $cart->shippingSurchargeTotal();
    
        $total = $cart->subtotal() - $cart->giftCardTotal() - $cart->discountTotal() - $cart->creditTotal();
    
        $method = new \Shop\Models\ShippingMethods(array(
            'id' => 'tasha.domestic.standard',
            'name' => 'Flat Rate Shipping',
            'price' => '4.99',
            'extra' => $item_surcharges,
        ));
        $methods[] = $method->cast();
    
        $event->setArgument('methods', $methods);
    
        return;
    }
    
    /**
     * @param string $fullName
     * @return array
     */
    protected function parseName($fullName)
    {
        $name = explode(' ', trim($fullName), 2);
    
        if(empty($name[0])) {
            $name[0] = '';
        }
    
        if(empty($name[1])) {
            $name[1] = '';
        }
    
        return [
            'first' => $name[0],
            'last'  => $name[1]
        ];
    }
    
}