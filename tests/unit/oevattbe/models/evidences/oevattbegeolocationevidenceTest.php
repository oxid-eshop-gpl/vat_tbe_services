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
 * @copyright (C) OXID eSales AG 2003-2014T
 */

/**
 * Test class for oeVATTBEEvidenceCalculator.
 *
 * @covers oeVATTBEGeoLocationEvidence
 */
class Unit_oeVATTBE_Models_Evidences_oeVATTBEGeoLocationEvidenceTest extends OxidTestCase
{

    public function testGetName()
    {
        /** @var oxUser|PHPUnit_Framework_MockObject_MockObject $oUser */
        $oUser = $this->getMock('oxUser', array(), array(), '', false);
        $oEvidence = new oeVATTBEGeoLocationEvidence($oUser);

        $this->assertEquals('geo_location', $oEvidence->getName());
    }

    public function testGetCountryId()
    {
        /** @var oxUser|PHPUnit_Framework_MockObject_MockObject $oUser */
        $oUser = $this->getMock('oxUser', array(), array(), '', false);
        $oEvidence = new oeVATTBEGeoLocationEvidence($oUser);

        $this->assertEquals('', $oEvidence->getCountryId());
    }
}