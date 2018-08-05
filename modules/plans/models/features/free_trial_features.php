<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * This file sets the default or initial features for Package::FREE_TRIAL
 * @see plan/models/Feature for full list of features
 *
 * @author kwlok
 */
return [
    'hasShopLimitTier1',//1 shop only
    'hasProductLimitTier1',//25 products only
    //Free trial should not have unlimited access, default use tier2
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
    'hasStorageLimitTier2',
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
