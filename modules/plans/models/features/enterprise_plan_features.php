<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * This file sets the default or initial features for Package::ENTERPRISE
 * @see plan/models/Feature for full list of features
 * 
 * @author kwlok
 */
return [
    'hasShopLimitTier1',//one shop only
    'hasShopThemeLimitTier3',
    //unlimited access
    'hasProductLimitTierN',
    'hasProductCategoryLimitTierN',
    'hasProductSubcategoryLimitTierN',
    'hasProductBrandLimitTierN',
    'hasShippingLimitTierN',
    'hasTaxLimitTierN',
    'hasPaymentMethodLimitTierN',
    'hasNewsLimitTierN',
    'hasSaleCampaignLimitTierN',
    'hasBGACampaignLimitTierN',
    'hasPromocodeCampaignLimitTierN',       
    'hasStorageLimitTierN',
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
    //extra features
    'broadcastNewsToSubscribers',
    'supportGoogleTagManager',
    'supportMultipleUsers',
    'recoverAbandonedCarts',
    'hasProfessionalReports',
];
