<?php 
namespace ShipStation\Site\Controllers;

class Orders extends \ShipStation\Site\Controllers\StationAuth
{
    /*
     * https://help.shipstation.com/hc/en-us/articles/205928478#2a
     * ?action=export&start_date=01%2f23%2f2012+17%3a28&end_date=01%2f23%2f2012+17%3a33&page=1
     */
    public function getHandler() {
        $action =  $this->app->get('GET.action');


        switch ($action) {
            case 'export':
                $this->exportOrders();
                break;

            default:
                ;
                break;
        }

    }

    protected  function exportOrders() {
        header('Content-Type: text/xml');

        $start =  $this->app->get('GET.start_date');
        $end =  $this->app->get('GET.end_date');
        $page =  $this->app->get('GET.page');

        //echo $start.'<br>';
        //echo $end;
        $UTC = new \DateTimeZone("UTC");
        $start = \DateTime::createFromFormat('m/d/Y H:i', $start,$UTC);
        $end = \DateTime::createFromFormat('m/d/Y H:i', $end,$UTC);

        $newTZ = new \DateTimeZone(
            \Base::instance()->get('TZ')
        );

        $start->setTimezone($newTZ);
        $end->setTimezone($newTZ);


        $orders = \Shop\Models\Orders::collection()->find([
            'metadata.last_modified.time' => [ '$gte' => $start->getTimestamp() ],
            'metadata.last_modified.time' => [ '$lte' => $end->getTimestamp() ],
            ]
        );



        $oXMLWriter = new \XMLWriter;
        $oXMLWriter->openMemory();
        $oXMLWriter->startDocument('1.0', 'UTF-8');

        $oXMLWriter->startElement('Orders');
        foreach ($orders as $order) {




            $order = (new \Shop\Models\Orders)->bind($order);
            $oXMLWriter->startElement('Order');

            $oXMLWriter->startElement('OrderID');
            $oXMLWriter->writeCData($order->id);
            $oXMLWriter->endElement();

            $oXMLWriter->startElement('OrderNumber');
            $oXMLWriter->writeCData($order->number);
            $oXMLWriter->endElement();
            $date = new \DateTime();
            $date->setTimezone($newTZ);
            $date->setTimestamp($order->get('metadata.created.time'));
            $date->setTimezone($UTC);
            $oXMLWriter->startElement('OrderDate');
            $oXMLWriter->writeCData($date->format('m/d/Y G:i A'));
            $oXMLWriter->endElement();

            $date = new \DateTime();
            $date->setTimezone($newTZ);
            $date->setTimestamp($order->get('metadata.last_modified.time'));
            $date->setTimezone($UTC);
            $oXMLWriter->startElement('LastModified');
            $oXMLWriter->writeCData($date->format('m/d/Y G:i A'));
            $oXMLWriter->endElement();

            $oXMLWriter->startElement('OrderStatus');
            $oXMLWriter->writeCData('paid');
            $oXMLWriter->endElement();

            $oXMLWriter->startElement('ShippingMethod');
            $oXMLWriter->writeCData($order->get('shipping_method.name'));
            $oXMLWriter->endElement();

            $oXMLWriter->startElement('OrderTotal');
            $oXMLWriter->writeCData($order->grand_total);
            $oXMLWriter->endElement();

            $oXMLWriter->startElement('TaxAmount');
            $oXMLWriter->writeCData($order->tax_total);
            $oXMLWriter->endElement();

            $oXMLWriter->startElement('ShippingAmount');
            $oXMLWriter->writeCData($order->shipping_total);
            $oXMLWriter->endElement();


            $oXMLWriter->startElement('Gift');
            $oXMLWriter->text('false');
            $oXMLWriter->endElement();

            /*
             * CUSTOMER SECTION
             */
            $oXMLWriter->startElement('Customer');
                $oXMLWriter->startElement('CustomerCode');
                $oXMLWriter->writeCData($order->get('customer._id'));
                $oXMLWriter->endElement();

                $oXMLWriter->startElement('BillTo');
                    $oXMLWriter->startElement('Name');
                    $oXMLWriter->writeCData($order->get('billing_address.name'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Phone');
                    $oXMLWriter->writeCData($order->get('billing_address.phone_number'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Email');
                    $oXMLWriter->writeCData($order->get('user_email'));
                    $oXMLWriter->endElement();
                $oXMLWriter->endElement(); //BillTo

                $oXMLWriter->startElement('ShipTo');
                    $oXMLWriter->startElement('Name');
                    $oXMLWriter->writeCData($order->get('shipping_address.name'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Address1');
                    $oXMLWriter->writeCData($order->get('shipping_address.line_1'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Address2');
                    $oXMLWriter->writeCData($order->get('shipping_address.line_2'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('City');
                    $oXMLWriter->writeCData($order->get('shipping_address.region'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('State');
                    $oXMLWriter->writeCData($order->get('shipping_address.region'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('PostalCode');
                    $oXMLWriter->writeCData($order->get('shipping_address.postal_code'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Country');
                    $oXMLWriter->writeCData($order->get('shipping_address.country'));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Phone');
                    $oXMLWriter->writeCData($order->get('shipping_address.phone_number'));
                    $oXMLWriter->endElement();
                $oXMLWriter->endElement(); //ShipTo

            $oXMLWriter->endElement(); //customer


            /*
             * ITEMS
             */
            $oXMLWriter->startElement('Items');
            foreach ($order->items as $item) {
                $oXMLWriter->startElement('Item');
                    $oXMLWriter->startElement('SKU');
                    $oXMLWriter->writeCData($item['model_number']);
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Name');
                    $oXMLWriter->writeCData(substr($item['product']['title'],0,200));
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('Quantity');
                    $oXMLWriter->writeCData($item['quantity']);
                    $oXMLWriter->endElement();

                    $oXMLWriter->startElement('UnitPrice');
                    $oXMLWriter->writeCData($item['price']);
                    $oXMLWriter->endElement();

                $oXMLWriter->endElement(); //Item

            }
            $oXMLWriter->endElement(); //Items


            $oXMLWriter->endElement(); //Order
        }


        $oXMLWriter->endElement(); //Orders

        $oXMLWriter->endDocument();
        echo $oXMLWriter->outputMemory(TRUE);




    }

    public function postHander()
    {

        \Base::instance()->set('pagetitle', 'Home');
        \Base::instance()->set('subtitle', '');

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->setVariant('home')->render('Chopperparts/Site/Views::home/index.php');
    }
}
