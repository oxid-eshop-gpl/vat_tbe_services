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
 * VAT TBE oxBasket class
 */
class oeVATTBEOxBasket extends oeVatTbeOxBasket_parent
{
    /**
     * TBE country id
     *
     * @var string
     */
    private $_sTBECountryId = null;

    /**
     * Return tbe country id
     *
     * @return string
     */
    public function getTBECountryId()
    {
        return $this->_sTBECountryId;
    }

    /**
     * Returns if basket has tbe articles in it.
     *
     * @return bool
     */
    public function hasVATTBEArticles()
    {
        $blHasTBEArticles = false;
        $oBasketArticles = $this->getBasketArticles();
        foreach ($oBasketArticles as $oArticle) {
            /** @var oxArticle $oArticle */
            if ($oArticle->isTBEService()) {
                $blHasTBEArticles = true;
                break;
            }
        }

        return $blHasTBEArticles;
    }

    /**
     * Set tbe country id
     *
     * @param string $sTBECountryId tbe country id
     */
    public function setTBECountryId($sTBECountryId)
    {
        $this->_sTBECountryId = $sTBECountryId;
    }
}
