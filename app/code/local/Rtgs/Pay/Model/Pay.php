<?php
class Rtgs_Pay_Model_Pay extends Mage_Payment_Model_Method_Abstract
{
	protected $_code 			= 'pay';
	protected $_formBlockType 	= 'pay/form_pay';
	protected $_infoBlockType 	= 'pay/info_pay';

	public function assignData($data)
	{
		if (!($data instanceof Varien_Object)) {
			$data = new Varien_Object($data);
		}

		$info = $this->getInfoInstance();
		$info->setTransactionNo($data->getTransactionNo());
		return $this;
	}


	public function validate()
	{
		parent::validate();

		$info	= $this->getInfoInstance();
		$no 	= $info->getTransactionNo();

		if(empty($no)){
			$errorCode = 'invalid_data';
			$errorMsg = $this->_getHelper()->__('Transaction No is required fields');
		}

		if($errorMsg){
			Mage::throwException($errorMsg);
		}

		return $this;
	}
}
?>