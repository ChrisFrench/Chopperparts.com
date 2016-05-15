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
    
}