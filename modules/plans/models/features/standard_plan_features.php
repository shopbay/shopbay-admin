<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * This file sets the default or initial features for Package::STANDARD
 * @see plan/models/Feature for full list of features
 * 
 * @author kwlok
 */
return [
    'hasShopLimitTier1',//one shop only
    //tier 2
    'hasShopThemeLimitTier2',
    'hasProductLimitTier2',
    'hasProductCategoryLimitTier2',
    'hasProductSubcategoryLimitTier2',
    'hasNewsLimitTier2',
    'hasSaleCampaignLimitTier2',
    'hasBGACampaignLimitTier2',
    'hasPromocodeCampaignLimitTier2',
    'hasStorageLimitTier2',
    'hasPageLimitTier2',
    //unlimited access
    'hasProductBrandLimitTierN',
    'hasPaymentMethodLimitTierN',
    'hasShippingLimitTierN',
    'hasTaxLimitTierN',
    //others
    'importProductsByFile',
    'hasShopDesignTool',
    'hasCustomDomain',
    'hasShopDashboard',
    'addShopToFacebookPage',
    'integrateFacebookMessenger',
    'hasSocialMediaShareButton',
    'hasSEOConfigurator',
    'processOrders',
    'customizeOrderNumber',
    'manageInventory',
    'manageQuestions',
    'manageCustomers',
];
