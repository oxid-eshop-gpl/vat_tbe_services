<?php
/**
 * This file is part of OXID eSales VAT TBE module.
 *
 * OXID eSales PayPal module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales PayPal module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales VAT TBE module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2014
 */


/**
 * Testing extended oxArticle class.
 *
 * @covers oeVATTBEOxOrder
 */
class Unit_oeVATTBE_models_oeVATTBEOxOrderTest extends OxidTestCase
{
    public function testValidateOrderNotValidOtherValidationOk()
    {
        $oBasket = $this->getMock("oxBasket", array("getTbeCountryId"));
        $oBasket->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oUser = $this->getMock("oxUser", array("getTbeCountryId"));
        $oUser->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('lt'));

        $oOrder = $this->getMock("oeVATTBEOxOrder", array("_getValidateOrderParent"));
        $oOrder->expects($this->any())->method("_getValidateOrderParent")->will($this->returnValue(0));

        $this->assertSame(oxOrder::ORDER_STATE_INVALIDDElADDRESSCHANGED, $oOrder->validateOrder($oBasket, $oUser));
    }

    public function testValidateOrderValidOtherValidationOk()
    {
        $oBasket = $this->getMock("oxBasket", array("getTbeCountryId"));
        $oBasket->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oUser = $this->getMock("oxUser", array("getTbeCountryId"));
        $oUser->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oOrder = $this->getMock("oeVATTBEOxOrder", array("_getValidateOrderParent"));
        $oOrder->expects($this->any())->method("_getValidateOrderParent")->will($this->returnValue(0));

        $this->assertSame(0, $oOrder->validateOrder($oBasket, $oUser));
    }

    public function testValidateOrderUserHasNoTBECountryOtherValidationOk()
    {
        $oBasket = $this->getMock("oxBasket", array("getTbeCountryId"));
        $oBasket->expects($this->any())->method("getTbeCountryId")->will($this->returnValue(null));

        $oUser = $this->getMock("oxUser", array("getTbeCountryId"));
        $oUser->expects($this->any())->method("getTbeCountryId")->will($this->returnValue(null));

        $oOrder = $this->getMock("oeVATTBEOxOrder", array("_getValidateOrderParent"));
        $oOrder->expects($this->any())->method("_getValidateOrderParent")->will($this->returnValue(0));

        $this->assertSame(0, $oOrder->validateOrder($oBasket, $oUser));
    }

    public function testValidateOrderValidOtherValidationNotOk()
    {
        $oBasket = $this->getMock("oxBasket", array("getTbeCountryId"));
        $oBasket->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oUser = $this->getMock("oxUser", array("getTbeCountryId"));
        $oUser->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oOrder = $this->getMock("oeVATTBEOxOrder", array("_getValidateOrderParent"));
        $oOrder->expects($this->any())->method("_getValidateOrderParent")->will($this->returnValue(1));

        $this->assertSame(1, $oOrder->validateOrder($oBasket, $oUser));
    }

    public function testValidateOrderArticleCheckerNotValid()
    {
        $oBasket = $this->getMock("oxBasket", array("getTbeCountryId"));
        $oBasket->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oUser = $this->getMock("oxUser", array("getTbeCountryId"));
        $oUser->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oChecker = $this->getMock("oeVATTBEOrderArticleChecker", array("isValid"), array(), '', false);
        $oChecker->expects($this->any())->method("isValid")->will($this->returnValue(false));

        $oOrder = $this->getMock("oeVATTBEOxOrder", array("_getValidateOrderParent", "_getOeVATTBEOrderArticleChecker"));
        $oOrder->expects($this->any())->method("_getValidateOrderParent")->will($this->returnValue(0));
        $oOrder->expects($this->any())->method("_getOeVATTBEOrderArticleChecker")->will($this->returnValue($oChecker));

        $this->assertSame(oeVATTBEOxOrder::ORDER_STATE_TBE_NOT_CONFIGURED, $oOrder->validateOrder($oBasket, $oUser));
    }

    public function testValidateOrderArticleCheckerValid()
    {
        $oBasket = $this->getMock("oxBasket", array("getTbeCountryId"));
        $oBasket->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oUser = $this->getMock("oxUser", array("getTbeCountryId"));
        $oUser->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oChecker = $this->getMock("oeVATTBEOrderArticleChecker", array("isValid"), array(), '', false);
        $oChecker->expects($this->any())->method("isValid")->will($this->returnValue(true));

        $oOrder = $this->getMock("oeVATTBEOxOrder", array("_getValidateOrderParent", "_getOeVATTBEOrderArticleChecker"));
        $oOrder->expects($this->any())->method("_getValidateOrderParent")->will($this->returnValue(0));
        $oOrder->expects($this->any())->method("_getOeVATTBEOrderArticleChecker")->will($this->returnValue($oChecker));

        $this->assertSame(0, $oOrder->validateOrder($oBasket, $oUser));
    }

    public function testValidateOrderArticleCheckerInValidParentInvalid()
    {
        $oBasket = $this->getMock("oxBasket", array("getTbeCountryId"));
        $oBasket->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oUser = $this->getMock("oxUser", array("getTbeCountryId"));
        $oUser->expects($this->any())->method("getTbeCountryId")->will($this->returnValue('de'));

        $oChecker = $this->getMock("oeVATTBEOrderArticleChecker", array("isValid"), array(), '', false);
        $oChecker->expects($this->any())->method("isValid")->will($this->returnValue(false));


        $oOrder = $this->getMock("oeVATTBEOxOrder", array("_getValidateOrderParent", "_getOeVATTBEOrderArticleChecker"));
        $oOrder->expects($this->any())->method("_getValidateOrderParent")->will($this->returnValue(1));
        $oOrder->expects($this->any())->method("_getOeVATTBEOrderArticleChecker")->will($this->returnValue($oChecker));

        $this->assertSame(1, $oOrder->validateOrder($oBasket, $oUser));
    }
}
