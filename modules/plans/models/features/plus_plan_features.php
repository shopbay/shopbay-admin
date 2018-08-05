<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * This file sets the default or initial features for Package::PLUS
 * @see plan/models/Feature for full list of features
 * 
 * @author kwlok
 */
return [
    'hasShopLimitTier1',//one shop only
    //tier 3
    'hasShopThemeLimitTier3',
    'hasProductLimitTier3',
    'hasStorageLimitTier3',
    //unlimited access
    'hasProductCategoryLimitTierN',
    'hasProductSubcategoryLimitTierN',
    'hasProductBrandLimitTierN',
    'hasPaymentMethodLimitTierN',
    'hasShippingLimitTierN',
    'hasTaxLimitTierN',
    'hasNewsLimitTierN',
    'hasSaleCampaignLimitTierN',
    'hasBGACampaignLimitTierN',
    'hasPromocodeCampaignLimitTierN',
    'hasPageLimitTierN',
    //others
    'hasShopDesignTool',
    'hasCustomDomain',
    'hasShopDashboard',
    'hasCSSEditing',
    'importProductsByFile',
    'manageInventory',
    'receiveLowStockAlert',
    'manageQuestions',
    'addShopToFacebookPage',
    'integrateFacebookMessenger',
    'hasSocialMediaShareButton',
    'hasEmailTemplateConfigurator',
    'hasSEOConfigurator',
    'processOrders',
    'customizeOrderNumber',
    'manageCustomers',
    'trackCustomerBehaviors',
];
