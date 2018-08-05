<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * This file sets the default or initial features for Package::FREE
 * @see plan/models/Feature for full list of features
 *
 * @author kwlok
 */
return [
    //free tier access
    'hasProductLimitTierFree',//special free tier, 100 products only
    'hasStorageLimitTierFree',//special free tier, 250 MB
    //tier1 access
    'hasShopLimitTier1',
    'hasShopThemeLimitTier1',
    'hasProductCategoryLimitTier1',
    'hasProductSubcategoryLimitTier1',
    'hasNewsLimitTier1',
    'hasSaleCampaignLimitTier1',
    'hasBGACampaignLimitTier1',
    'hasPromocodeCampaignLimitTier1',
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
    'hasCSSEditing',
    'importProductsByFile',
    'manageInventory',
    'manageQuestions',
    'receiveLowStockAlert',
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
