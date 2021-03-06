<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * @var \Magento\Catalog\Model\Product $product
 */
$product = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create('Magento\Catalog\Model\Product');
$product
    ->setTypeId(\Magento\Downloadable\Model\Product\Type::TYPE_DOWNLOADABLE)
    ->setId(1)
    ->setAttributeSetId(4)
    ->setWebsiteIds([1])
    ->setName('Downloadable Product')
    ->setSku('downloadable-product')
    ->setPrice(10)
    ->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH)
    ->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
    ->setLinksPurchasedSeparately(true);

/**
 * @var \Magento\Downloadable\Api\Data\LinkInterfaceFactory $linkFactory
 */
$linkFactory = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->get('Magento\Downloadable\Api\Data\LinkInterfaceFactory');
$links = [];
$linkData = [
    'title' => 'Downloadable Product Link',
    'type' => \Magento\Downloadable\Helper\Download::LINK_TYPE_URL,
    'is_shareable' => \Magento\Downloadable\Model\Link::LINK_SHAREABLE_CONFIG,
    'link_url' => 'http://example.com/downloadable.txt',
    'link_id' => 0,
    'is_delete' => null,
];
$link = $linkFactory->create(['data' => $linkData]);
$link->setId(null);
$link->setLinkType($linkData['type']);
$link->setStoreId($product->getStoreId());
$link->setWebsiteId($product->getStore()->getWebsiteId());
$link->setProductWebsiteIds($product->getWebsiteIds());
$link->setSortOrder(1);
$link->setPrice(0);
$link->setNumberOfDownloads(0);
$links[] = $link;
$extension = $product->getExtensionAttributes();
$extension->setDownloadableProductLinks($links);
$product->setExtensionAttributes($extension);

$product->save();
