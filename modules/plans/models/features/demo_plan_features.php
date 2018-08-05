<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * This file sets the default or initial features for demo use
 * Since demo will be free of charge, we can can Package::FREE as the feature container.
 * Load the features into Plan::FREE
 * 
 * @see plan/models/Feature for full list of features
 * 
 * @author kwlok
 */
return [
    //For demo purpose
    'hasShopLimitTier1',//1 shop only
    'hasProductLimitTier1',//25 products only
    'hasStorageLimitTierFree',//250M 
    //Demo plan to have full features access, but not unlimited access; Use tier2 for restriction
    'hasShopThemeLimitTier2',
    'hasProductCategoryLimitTier2',
    'hasProductSubcategoryLimitTier2',
    'hasProductBrandLimitTier2',
    'hasShippingLimitTier2',
    'hasTaxLimitTier2',
    'hasPaymentMethodLimitTier2',
    'hasNewsLimitTier2',
    'hasSaleCampaignLimitTier2',
    'hasBGACampaignLimitTier2',
    'hasPromocodeCampaignLimitTier2',
    'hasPageLimitTier2',
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
