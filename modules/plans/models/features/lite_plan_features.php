<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * This file sets the default or initial features for Package::LITE
 * @see plan/models/Feature for full list of features
 *
 * @author kwlok
 */
return [
    //tier1 access
    'hasShopLimitTier1',
    'hasShopThemeLimitTier1',
    'hasProductLimitTier1',
    'hasProductCategoryLimitTier1',
    'hasProductSubcategoryLimitTier1',
    'hasNewsLimitTier1',
    'hasSaleCampaignLimitTier1',
    'hasBGACampaignLimitTier1',
    'hasPromocodeCampaignLimitTier1',
    'hasStorageLimitTier1',
    'hasPageLimitTier1',
    //unlimited access
    'hasProductBrandLimitTierN',
    'hasPaymentMethodLimitTierN',
    'hasShippingLimitTierN',
    'hasTaxLimitTierN',
    //others
    'hasShopDesignTool',
    'hasCustomDomain',
    'hasShopDashboard',
    'hasSocialMediaShareButton',
    'manageInventory',
    'manageQuestions',
    'processOrders',
];
