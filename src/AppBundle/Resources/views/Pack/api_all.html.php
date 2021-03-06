<?php
$list = array();
foreach ($packs as $key => $pack) {
	if (sizeof($pack->getStickers())>2) {
		$a["identifier"] = $pack->getId();
		$a["name"] = $pack->getName();
		$a["publisher"] = $pack->getPublisher();
		$a["tray_image_file"] = $this['imagine']->filter($view['assets']->getUrl($pack->getImage()->getLink()), 'tray_image');
		$a["publisher_email"] = $pack->getPublisheremail();
		$a["publisher_website"] = $pack->getPublisherwebsite();
		$a["privacy_policy_website"] = $pack->getPrivacypolicywebsite();
		$a["license_agreement_website"] = $pack->getLicenseagreementwebsite();
		$a["premium"] = $pack->getPremiumValue();
		$a["animated"] = $pack->getAnimatedValue();
		$a["whatsapp"] = $pack->getWhatsappValue();
		$a["telegram"] = $pack->getTelegramValue();
		$a["signal"] = $pack->getSignalValue();
		$a["signalurl"] = $pack->getSignalurl();
		$a["telegramurl"] = $pack->getTelegramurl();
		$a["review"] = $pack->getReviewValue();
		$a["trusted"] = $pack->getUser()->getTrusedValue();
		$a["downloads"] = $pack->getDownloadValue();
		$a["size"] = $pack->getSizes();
		$a["created"] = $view['time']->diff($pack->getCreated());
		$a["user"] = $pack->getUser()->getName();
		$a["userid"] = $pack->getUser()->getId() . "";
		$a["userimage"] = $pack->getUser()->getImage();
		$stickers = array();
		foreach ($pack->getStickers() as $key => $sticker) {
			if ($sticker->getMedia()->getType()=="image/webp") {
				$s["image_file_thum"] = $app->getRequest()->getSchemeAndHttpHost()."/".$sticker->getMedia()->getLink();
				$s["image_file"] = $app->getRequest()->getSchemeAndHttpHost()."/".$sticker->getMedia()->getLink();
				$s["emojis"] = array($sticker->getEmojis());
				$stickers[] = $s;	
			}else{
				$s["image_file_thum"] = $this['imagine']->filter($view['assets']->getUrl($sticker->getMedia()->getLink()), 'sticker_image_thum');
				$s["image_file"] = $app->getRequest()->getSchemeAndHttpHost()."/".$sticker->getMedia()->getLink();
				$s["emojis"] = array($sticker->getEmojis());
				$stickers[] = $s;			
			}

		}
		$a["stickers"] = $stickers;
		$list[] = $a;
	}
}
$object["sticker_packs"] = $list;
echo json_encode($list, JSON_UNESCAPED_SLASHES);?>