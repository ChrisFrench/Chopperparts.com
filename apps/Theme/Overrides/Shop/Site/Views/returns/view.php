<div class="row">
	<div class="col-xs-12 paddingTop paddingBottom text-center">
		<img src="/theme/img/rma_process_rsd.png" class="img-responsive">
	</div>
</div>
	<div class="well paddingTop">
	<h3>Your Return Authorization (RMA) number is: <strong><span class="text-success"><?php echo $return->number;?></span></strong> <br/>
	Your return must arrive at our facility on or before <strong><?php  echo date('F t, Y', strtotime("+30 days")); ?></strong><br/>
	</h3>
	<br>
	<ol>
	
	
	<li>Package everything you've selected to return as it was originally shipped to you. Include all original products, boxes, and packing materials.</li>
	<li>
        Create a shipping label using your carrier of choice (we recommend UPS or USPS), and don't forget to insure it; the return shipping address is listed below. Make sure the RMA number is on the shipping label and then attach the label to the box. Do not write on the original packaging. If there are any labels or stickers from previous shipments on the box, please remove them before tendering your package to the shipping carrier.<br>
        <span style="font-size: 12px"> *International returns need to be marked as <strong>FREE DOMICILE</strong> to prevent any customs or duties charges from being deducted from the return.  Any customs or duties charges incurred upon returning an international shipment will be charged to the original form of payment.</span>
    </li>
	<li>Give the package to an approved carrier.</li>
	<li>Wait for a confirmation email from RallySportDirect.com. Once our fulfillment center has received your return and verified its eligibility, we will refund your original form of payment and notify you via email that your return is complete.</li>
	</ol>
	<hr>
	Return Shipping Address:
	<address>
	<strong>RallySport Direct</strong><br/>
	RMA: <?php echo $return->number;?><br/>
	218 W. 12650 S.<br/>
	Draper, UT 84020<br/>
	</address>
	</div>
