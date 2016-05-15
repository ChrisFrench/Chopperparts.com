<?php
namespace Sync\Models\Objects;

class Order extends AbstractBase
{
    // order basics
    protected $OrderID;
    protected $OrderNumber;
    protected $OrderStatus;
    protected $orderProcessStatus;

    protected $orderContactName;
    protected $originalOrderNumber;
    protected $orderPaymentTerms;
    protected $orderPriceLevel;
    protected $orderCreationDate;
    protected $orderOrderNumber;
    protected $orderCustomerNumber;
    protected $orderCustomerName;
    protected $orderSalesRepName;
    protected $orderSalesRepNumber;
    protected $orderPoNumber;
    protected $orderProcessState;
    protected $orderSalesTerritory;
    protected $orderPaymentsReceived;
    protected $orderActualShipDate;
    protected $orderShipComplete;

    // money
    protected $orderMiscTotal;

    protected $orderGrandTotal;
    protected $orderSubTotal;
    protected $orderTaxTotal;
    protected $orderShippingTotal;
    protected $orderDiscountTotal;
    protected $orderShippingDiscountTotal;
    protected $orderCreditTotal;
    protected $orderGiftCardTotal;

    // shipping
    protected $orderShippingMethodName;
    protected $orderShippingId;
    protected $orderShippingPrice;
    protected $orderShippingAddressName;
    protected $orderShippingAddressLineOne;
    protected $orderShippingAddressLineTwo;
    protected $orderShippingAddressCountry;
    protected $orderShippingAddressPostalCode;
    protected $orderShippingAddressCity;
    protected $orderShippingAddressRegion;
    protected $orderShippingAddressPhoneNumber;


    /**
     * {@inheritDoc}
     */
    protected function getRequiredFields()
    {
        return [
            'orderNumber'
        ];
    }

    /**
     * @param string $orderNumber
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        return $this->set('orderNumber', $orderNumber);
    }

    /**
     * @param string $orderStatus
     * @return $this
     */
    public function setOrderStatus($orderStatus)
    {
        return $this->set('orderStatus', $orderStatus);
    }

    /**
     * @param string $orderProcessStatus
     * @return $this
     */
    public function setOrderProcessStatus($orderProcessStatus)
    {
        return $this->set('orderProcessStatus', $orderProcessStatus);
    }

    /**
     * @param string $orderGrandTotal
     * @return $this
     */
    public function setOrderGrandTotal($orderGrandTotal)
    {
        return $this->set('orderGrandTotal', $orderGrandTotal);
    }

    /**
     * @param string $orderSubTotal
     * @return $this
     */
    public function setOrderSubTotal($orderSubTotal)
    {
        return $this->set('orderSubTotal', $orderSubTotal);
    }

    /**
     * @param string $orderTaxTotal
     * @return $this
     */
    public function setOrderTaxTotal($orderTaxTotal)
    {
        return $this->set('orderTaxTotal', $orderTaxTotal);
    }

    /**
     * @param string $orderShippingTotal
     * @return $this
     */
    public function setOrderShippingTotal($orderShippingTotal)
    {
        return $this->set('orderShippingTotal', $orderShippingTotal);
    }

    /**
     * @param string $orderDiscountTotal
     * @return $this
     */
    public function setOrderDiscountTotal($orderDiscountTotal)
    {
        return $this->set('orderDiscountTotal', $orderDiscountTotal);
    }

    /**
     * @param string $orderShippingDiscountTotal
     * @return $this
     */
    public function setOrderShippingDiscountTotal($orderShippingDiscountTotal)
    {
        return $this->set('orderShippingDiscountTotal', $orderShippingDiscountTotal);
    }

    /**
     * @param string $orderCreditTotal
     * @return $this
     */
    public function setOrderCreditTotal($orderCreditTotal)
    {
        return $this->set('orderCreditTotal', $orderCreditTotal);
    }

    /**
     * @param string $orderGiftCardTotal
     * @return $this
     */
    public function setOrderGiftCardTotal($orderGiftCardTotal)
    {
        return $this->set('orderGiftCardTotal', $orderGiftCardTotal);
    }

    /**
     * @param string $orderShippingMethodName
     * @return $this
     */
    public function setOrderShippingMethodName($orderShippingMethodName)
    {
        return $this->set('orderShippingMethodName', $orderShippingMethodName);
    }

    /**
     * @param string $orderShippingId
     * @return $this
     */
    public function setOrderShippingId($orderShippingId)
    {
        return $this->set('orderShippingId', $orderShippingId);
    }

    /**
     * @param string $orderShippingPrice
     * @return $this
     */
    public function setOrderShippingPrice($orderShippingPrice)
    {
        return $this->set('orderShippingPrice', $orderShippingPrice);
    }

    /**
     * @param string $orderShippingAddressName
     * @return $this
     */
    public function setOrderShippingAddressName($orderShippingAddressName)
    {
        return $this->set('orderShippingAddressName', $orderShippingAddressName);
    }

    /**
     * @param string $orderShippingAddressLineOne
     * @return $this
     */
    public function setOrderShippingAddressLineOne($orderShippingAddressLineOne)
    {
        return $this->set('orderShippingAddressLineOne', $orderShippingAddressLineOne);
    }

    /**
     * @param string $orderShippingAddressLineTwo
     * @return $this
     */
    public function setOrderShippingAddressLineTwo($orderShippingAddressLineTwo)
    {
        return $this->set('orderShippingAddressLineTwo', $orderShippingAddressLineTwo);
    }

    /**
     * @param string $orderShippingAddressCountry
     * @return $this
     */
    public function setOrderShippingAddressCountry($orderShippingAddressCountry)
    {
        return $this->set('orderShippingAddressCountry', $orderShippingAddressCountry);
    }

    /**
     * @param string $orderShippingAddressPostalCode
     * @return $this
     */
    public function setOrderShippingAddressPostalCode($orderShippingAddressPostalCode)
    {
        return $this->set('orderShippingAddressPostalCode', $orderShippingAddressPostalCode);
    }

    /**
     * @param string $orderShippingAddressCity
     * @return $this
     */
    public function setOrderShippingAddressCity($orderShippingAddressCity)
    {
        return $this->set('orderShippingAddressCity', $orderShippingAddressCity);
    }

    /**
     * @param string $orderShippingAddressRegion
     * @return $this
     */
    public function setOrderShippingAddressRegion($orderShippingAddressRegion)
    {
        return $this->set('orderShippingAddressRegion', $orderShippingAddressRegion);
    }

    /**
     * @param string $orderShippingAddressPhoneNumber
     * @return $this
     */
    public function setOrderShippingAddressPhoneNumber($orderShippingAddressPhoneNumber)
    {
        return $this->set('orderShippingAddressPhoneNumber', $orderShippingAddressPhoneNumber);
    }

    /**
     * @param string $orderContactName
     * @return $this
     */
    public function setOrderContactName($orderContactName)
    {
        return $this->set('orderContactName', $orderContactName);
    }

    /**
     * @param string $originalOrderNumber
     * @return $this
     */
    public function setOriginalOrderNumber($originalOrderNumber)
    {
        return $this->set('originalOrderNumber', $originalOrderNumber);
    }

    /**
     * @param string $orderPaymentTerms
     * @return $this
     */
    public function setOrderPaymentTerms($orderPaymentTerms)
    {
        return $this->set('orderPaymentTerms', $orderPaymentTerms);
    }

    /**
     * @param string $orderPriceLevel
     * @return $this
     */
    public function setOrderPriceLevel($orderPriceLevel)
    {
        return $this->set('orderPriceLevel', $orderPriceLevel);
    }

    /**
     * @param \DateTime $orderCreationDate
     * @return $this
     */
    public function setOrderCreationDate(\DateTime $orderCreationDate)
    {
        return $this->set('orderCreationDate', $orderCreationDate->getTimestamp());
    }

    /**
     * @param string $orderOrderNumber
     * @return $this
     */
    public function setOrderOrderNumber($orderOrderNumber)
    {
        return $this->set('orderOrderNumber', $orderOrderNumber);
    }

    /**
     * @param string $orderCustomerNumber
     * @return $this
     */
    public function setOrderCustomerNumber($orderCustomerNumber)
    {
        return $this->set('orderCustomerNumber', $orderCustomerNumber);
    }

    /**
     * @param string $orderCustomerName
     * @return $this
     */
    public function setOrderCustomerName($orderCustomerName)
    {
        return $this->set('orderCustomerName', $orderCustomerName);
    }

    /**
     * @param string $orderShippingMethod
     * @return $this
     */
    public function setOrderShippingMethod($orderShippingMethod)
    {
        return $this->set('orderShippingMethod', $orderShippingMethod);
    }

    /**
     * @param string $orderSalesRepName
     * @return $this
     */
    public function setOrderSalesRepName($orderSalesRepName)
    {
        return $this->set('orderSalesRepName', $orderSalesRepName);
    }

    /**
     * @param string $orderSalesRepNumber
     * @return $this
     */
    public function setOrderSalesRepNumber($orderSalesRepNumber)
    {
        return $this->set('orderSalesRepNumber', $orderSalesRepNumber);
    }

    /**
     * @param string $orderPoNumber
     * @return $this
     */
    public function setOrderPoNumber($orderPoNumber)
    {
        return $this->set('orderPoNumber', $orderPoNumber);
    }

    /**
     * @param string $orderProcessState
     * @return $this
     */
    public function setOrderProcessState($orderProcessState)
    {
        return $this->set('orderProcessState', $orderProcessState);
    }

    /**
     * @param string $orderSalesTerritory
     * @return $this
     */
    public function setOrderSalesTerritory($orderSalesTerritory)
    {
        return $this->set('orderSalesTerritory', $orderSalesTerritory);
    }

    /**
     * @param string $orderPaymentsReceived
     * @return $this
     */
    public function setOrderPaymentsReceived($orderPaymentsReceived)
    {
        return $this->set('orderPaymentsReceived', $orderPaymentsReceived);
    }

    /**
     * @param \DateTime $orderActualShipDate
     * @return $this
     */
    public function setOrderActualShipDate(\DateTime $orderActualShipDate)
    {
        return $this->set('orderActualShipDate', $orderActualShipDate->getTimestamp());
    }

    /**
     * @param string $orderShipComplete
     * @return $this
     */
    public function setOrderShipComplete($orderShipComplete)
    {
        return $this->set('orderShipComplete', $orderShipComplete);
    }

    /**
     * @param string $orderMiscTotal
     * @return $this
     */
    public function setOrderMiscTotal($orderMiscTotal)
    {
        return $this->set('orderMiscTotal', $orderMiscTotal);
    }
}
