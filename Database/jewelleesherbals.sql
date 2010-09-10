-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2010 at 08:30 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `jewelleesherbals`
--
CREATE DATABASE `jewelleesherbals` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jewelleesherbals`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--
-- Creation: Aug 21, 2010 at 09:47 AM
-- Last update: Aug 21, 2010 at 10:48 AM
--

CREATE TABLE IF NOT EXISTS `clients` (
  `email` varchar(255) DEFAULT '',
  `userid` int(12) NOT NULL AUTO_INCREMENT,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`email`, `userid`, `street_address`, `city`, `state`, `zip`, `phone`, `first_name`, `last_name`, `comments`) VALUES
('test@test.com', 6, 'test', 'test', 'test', 'test', 'test', 'test', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `herb_category`
--
-- Creation: Jul 27, 2010 at 01:42 PM
-- Last update: Jul 27, 2010 at 01:42 PM
--

CREATE TABLE IF NOT EXISTS `herb_category` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `herb_category`
--

INSERT INTO `herb_category` (`id`, `title`, `description`) VALUES
(1, 'External Use', ''),
(2, 'Internal Use', ''),
(3, 'Food', ''),
(4, 'Tonics', ''),
(5, 'Adaptogenic', ''),
(6, 'Acute Use', ''),
(7, 'Magickal Herbs', '');

-- --------------------------------------------------------

--
-- Table structure for table `herbs`
--
-- Creation: Jul 27, 2010 at 01:42 PM
-- Last update: Jul 27, 2010 at 01:42 PM
--

CREATE TABLE IF NOT EXISTS `herbs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cat_id` bigint(20) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `herb_name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_cat_id` (`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `herbs`
--


-- --------------------------------------------------------

--
-- Table structure for table `links`
--
-- Creation: Jul 27, 2010 at 01:42 PM
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order_` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `title`, `url`, `order_`) VALUES
(1, 'Home', './', 0),
(2, 'About_Me', './?page=about', 1),
(3, 'Products', './?page=products', 2),
(4, 'Contact_Me', './?page=contact', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--
-- Creation: Jul 27, 2010 at 01:42 PM
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `linktitle` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `pagetype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `linktitle`, `title`, `content`, `pagetype`) VALUES
(1, 'index', 'Welcome', '<P>Every product listed here is handmade by me, Jewellee.</P>\r\n\r\n<P>All of my products are made with only natural ingredients which means that I use nothing that doesn''t occur naturally and never use anything that is derived, extracted or separated more than is necessary (for example oils, butters, essential oils, alcohol for tinctures, etc). It is important to me to use the whole plant or plant parts since this is how nature offers them to us.</P>\r\n\r\n<P>Herbalism is slow and gentle and I try to encompass this in all that I offer here. Please take a look around and if you don''t find something you like, keep checking in because I will be adding new things and different varieties periodically. If you have any questions or comments, please email me.</P>', 'html'),
(2, 'products', 'Products', 'function get_products($category) {\r\n		\r\n			include_once("db.inc.php");\r\n	$db=new DB();\r\n	$db->open();\r\n		$query = "SELECT * FROM products WHERE category = $category order by product_name";\r\n		$result = $db->query($query);\r\n		$num_results = $db->numRows($result);\r\n		if ($DEBUG) echo $query . "<br>\\n";\r\n		if ($DEBUG) echo(''Invalid query: '' . mysql_error() . "<br>\\n");\r\n		for ($i=0; $i <$num_results; $i++)\r\n		{\r\n			$row = $db->fetchArray($result);\r\n$data=$row[content];?>\r\n			<table width="100%" border="0" align="center" cellpadding=0 cellspacing=0>\r\n        <tr border="0">\r\n            <td height="25px" width="100%" class="tcat" border="0">\r\n                <center><font size=+1>~ <? echo $row[product_name]; ?> ~</font></center></td>\r\n        </tr>\r\n        <tr border="0">\r\n            <td border="0" class="alt1"><center>\r\n            <TABLE BORDER=0 CELLPADDING=5 CELLSPACING=0 width="90%"><TR>\r\n                 <td valign="top" class="alt2" width="20%">\r\n          <? if ($row[product_image] != ""){\r\n          echo(''<a href="''.$row[product_image].''" target="_new"><img src="''.$row[product_image].''" width=90px height=90 border=0></a><BR><br> '');\r\n          }\r\n          echo ''Price: ''; \r\n          echo $row[product_price];\r\n         echo "<BR> Weight: ";\r\n         echo $row[product_weight];\r\n         echo " Oz.<BR>";\r\n if($row[paypaltype] == ''cart''){\r\n	?>\r\n<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">\r\n <? echo $row[option1]; ?>\r\n  <? echo $row[option2]; ?>\r\n<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but22.gif" border="0" name="submit" alt="Make payments with PayPal - it''s fast, free and secure!">\r\n<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">\r\n<input type="hidden" name="add" value="1">\r\n<input type="hidden" name="cmd" value="_cart">\r\n<input type="hidden" name="business" value="jewelleesmoons@msn.com">\r\n<input type="hidden" name="item_name" value="<? echo $row[product_name]; ?>">\r\n<input type="hidden" name="amount" value="<? echo $row[paypalprice]; ?>">\r\n<input type="hidden" name="weight" value="<? echo $row[paypalweight]; ?>">\r\n<input type="hidden" name="weight_unit" value="lbs">\r\n<input type="hidden" name="tax_rate" value="8.5%">\r\n<input type="hidden" name="return" value="./?page=success">\r\n<input type="hidden" name="cancel_return" value="./?page=cancel">\r\n<input type="hidden" name="currency_code" value="USD">\r\n<input type="hidden" name="no_shipping" value="2">\r\n<input type="hidden" name="bn" value="PP-ShopCartBF">\r\n</form>\r\n<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">\r\n<input type="hidden" name="cmd" value="_cart">\r\n<input type="hidden" name="business" value="jewelleesmoons@msn.com">\r\n<input type="image" src="https://www.paypal.com/en_US/i/btn/view_cart_02.gif" border="0" name="submit" alt="Make payments with PayPal - it''s fast, free and secure!">\r\n<input type="hidden" name="display" value="1">\r\n<input type="hidden" name="page_style" value="Primary">\r\n</form>\r\n<? }\r\n	\r\n	if ($row[paypaltype] == ''buy''){\r\n	?>\r\n	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">\r\n<input type="hidden" name="cmd" value="_xclick">\r\n<input type="hidden" name="business" value="jewelleesmoons@msn.com">\r\n<input type="hidden" name="undefined_quantity" value="1">\r\n<input type="hidden" name="item_name" value="<? echo $row[product_name]; ?>">\r\n<input type="hidden" name="amount" value="<? echo $row[paypalprice]; ?>">\r\n<input type="hidden" name="page_style" value="Primary">\r\n<input type="hidden" name="no_shipping" value="2">\r\n<input type="hidden" name="return" value="./?page=success">\r\n<input type="hidden" name="cancel_return" value="./?page=cancel">\r\n<input type="hidden" name="no_note" value="1">\r\n<input type="hidden" name="currency_code" value="USD">\r\n<input type="hidden" name="lc" value="US">\r\n<input type="hidden" name="bn" value="PP-BuyNowBF">\r\n<? echo $row[option1]; ?>\r\n<? echo $row[option2]; ?>\r\n<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it''s fast, free and secure!">\r\n<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">\r\n</form>\r\n	<?}\r\n	?></td>\r\n	<TD class="alt1" width=80%>\r\n	<? echo $row[product_description]; ?> \r\n	</td>\r\n        </tr>\r\n    </table></center>\r\n    </td></tr></table>\r\n    <HR>\r\n\r\n\r\n			<?PHP\r\n		}\r\n	}\r\nfunction get_product($product) {\r\n		\r\n			include_once("db.inc.php");\r\n	$db=new DB();\r\n	$db->open();\r\n		$query = "SELECT * FROM products WHERE id = $product";\r\n		$result = $db->query($query);\r\n		$num_results = $db->numRows($result);\r\n		if ($DEBUG) echo $query . "<br>\\n";\r\n		if ($DEBUG) echo(''Invalid query: '' . mysql_error() . "<br>\\n");\r\n		for ($i=0; $i <$num_results; $i++)\r\n		{\r\n			$row = $db->fetchArray($result);\r\n$data=$row[content];\r\n			include ''./skin/site/product.html'';\r\n\r\n		}\r\n	}	\r\nfunction get_product_cats() {\r\n		\r\n			include_once("db.inc.php");\r\n	$db=new DB();\r\n	$db->open();\r\n		$query = "SELECT * FROM product_category order by id";\r\n		$result = $db->query($query);\r\n		$num_results = $db->numRows($result);\r\n		if ($DEBUG) echo $query . "<br>\\n";\r\n		if ($DEBUG) echo(''Invalid query: '' . mysql_error() . "<br>\\n");\r\n		for ($i=0; $i <$num_results; $i++)\r\n		{\r\n			$row = $db->fetchArray($result);\r\n			echo(''<center> ~<a href="./?page=products&cat=''.$row[id].''">''.$row[category_name].''</a> ~<BR>''.$row[description].''</center><BR>'');\r\n\r\n		}\r\n	}\r\n	if(!isset($_GET[cat])){\r\n	get_product_cats();\r\n	}\r\n	elseif(isset($_GET[cat])){\r\n	\r\n	get_products($_GET[cat]);\r\n	}', 'php'),
(3, 'contact', 'Contact Me', 'Enter your information below to send me an Email<BR>\r\n<form method="POST" action="./?page=contact1">\r\n<table border="0" style="border-collapse: collapse" width="600px">\r\n<tr><td>Name:<BR><input type="text" name="Name" size="20"></td></tr>\r\n		<tr><td>Email:<BR><input type="text" name="Email" size="20"></td></tr>\r\n		<tr><td>Phone:<BR><input type="text" name="Phone" size="20"></td></tr>\r\n<tr>\r\n<td>Message:<BR><textarea rows="10" name="Comments" cols="50"></textarea></td></tr></table>\r\n<p><input type="submit" value="Submit" name="B1"></p></form>', 'html'),
(4, 'contact1', 'Contact Confirmation', '$email = $_POST[Email];\r\n$name = $_POST[Name];\r\n$phone = $_POST[Phone];\r\n$inquiry = $_POST[Comments];\r\nfunction handle_submission($name, $email, $phone,$inquiry) {\r\n	include_once("db.inc.php");\r\n	$db=new DB();\r\n	$db->open();\r\n		$query = "INSERT INTO submissions (name, email, phone, inquiry, notes) VALUES (''$name'', ''$email'', ''$phone'',''$inquiry'', ''NA'');";\r\n		$result = $db->query($query);\r\n		echo (''Your submission was successfull'');\r\n	}\r\n	\r\nif(!empty($email) && !empty($name) && !empty($phone) && !empty($inquiry)){\r\n	handle_submission($name, $email, $phone,$inquiry);\r\n}\r\nelse{\r\n	echo (''All fields are required please go back and enter all the information for your inquiry'');\r\n}', 'php'),
(5, 'about', 'About Me', 'My name is Jewellee.  I am woman, mother, lover, healer and owner of Jewellees Herbs. Healing has always been a passion of mine.  Over the years I have learned to pay attention to clues that point to imbalances in our bodies, our emotional states, our psyche and our environment, all of which have direct and cumulative effect on our health.  Through the years I have watched, studied and learned some of the ways that are and have been used to heal. \r\n<BR><BR>\r\nThis website came about as a way to share what I have learned with others. I am convinced that healing ourselves and each other is a necessary part of humanity that we have all but lost. People are always asking me to make them products for one reason or another or for advice as to which options are available to them. With this website I can make what I have available whether that be information or products.\r\n<BR><BR>\r\nIf you have any questions, whether they are about me, a specific herb or if you would like a specific product made for you please do not hesitate to email me. ', 'html');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--
-- Creation: Jul 27, 2010 at 01:42 PM
-- Last update: Aug 17, 2010 at 11:50 AM
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category_name`, `description`) VALUES
(1, 'Tinctures', 'These tinctures have an indefinite shelf life since they are made with 40% by volume alcohol. Just remember to keep the dropper clean, keep the container closed, cool and away from light when not using them.'),
(2, 'Cosmetics', 'All natural products that are designed to be put on the body for one reason or another that do not fit under the other categories\r\n'),
(3, 'Syrups', 'These syrups are all made with raw, local honey.  They have a shelf life of 6 months to a year, even when opened as long as they are refrigerated once opened.'),
(4, 'Teas', 'The teas are made with only plants and plant material. The ingredients are not irradiated or preserved in any other way and can become stale and less effective. The shelf life of teas is about 3 months if kept in an air tight container out of the sun.'),
(5, 'Balms, Salves, and Ointments', 'Balms have a shelf life of a few years and sometimes more.'),
(6, 'Miscellaneous', 'All natural products that do not fit under any other categories'),
(7, 'Lotions', 'The lotions that I make are made without chemical preservatives, like everything else I make.  Since they consist of mostly oils and water they can mold or go bad in other ways after 6-8 weeks or so. Refrigeration of freezing will extend the shelf life.  Some separation can occur and does not mean that the lotion is bad. Body butters generally have a longer shelf life of 4 months or so');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Creation: Jul 27, 2010 at 01:42 PM
-- Last update: Aug 18, 2010 at 07:02 AM
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_weight` varchar(255) NOT NULL,
  `paypaltype` varchar(255) NOT NULL,
  `paypalprice` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `paypalweight` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `product_name`, `product_description`, `product_price`, `product_image`, `product_weight`, `paypaltype`, `paypalprice`, `option1`, `option2`, `paypalweight`) VALUES
(4, '1', 'Black Elderberry', 'Black Elderberry is a staple in my house in the cold months.  Everyone knows that when they start to exhibit symptoms of achy muscles and joints, runny nose, sneezing and coughing and so on, that the Black Elderberry comes out in one form or another.   Black Elderberry is high in anthocyanins; a very important antioxidant that helps support the immune system, reduce inflammation and protect against cellular damage. Besides this, it is a mild diuretic, diaphoretic, tonic, and astringent (the latter two make it good for coughing, sore throat, gum and mouth swelling, etc).\r\n', '$7.00', 'http://jewelleesherbals.com/images/elderberry.png', '0.5 oz', 'cart', '7.00', '', '', '0.03'),
(5, '1', 'St. Johns Wort', 'St Johns Wort is an anti-bacterial, anti-inflammatory, anxiolytic, astringent, and diuretic, nervine, sedative and vulnerary. I use St Johns Wort tincture in situations where there is pain, spasm, nerve damage or dysfunction, stress, tension and anxiety.  \r\n<BR><BR>\r\nSt Johns Wort can cause photo-sensitivity and adverse reactions are probable when taken in conjunction with Alprazolam, Digoxin and MAOIs (or any other serotonin increasing drug, for that matter). Finally, because part of what St Johns Wort does is to help the liver break down toxins in the body it will decrease the functions of drugs taken so it is best just to get your health providers approval before taking St Johns Wort internally or in large amounts externally.\r\n', '$7.00', 'http://jewelleesherbals.com/images/stjohns.png', '0.5 oz', 'cart', '7.00', '', '', '0.03'),
(6, '1', 'Valerian Root', 'Valerian is antispasmodic, anxiolytic, hypotensive, hypnotic, nervine and sedative.  I use Valerian root tincture in situations where there is difficulty sleeping or getting to sleep and anxiety (useful in situations where there are withdrawal symptoms). Valerian root tincture helps relax smooth muscle cramping which makes it useful in colic, IBS and so on.Also, it is useful for some migraines and very helpful for menstrual dysfunction, especially where the flow is scanty or absent. I use Valerian tincture in combination with other herbs for mental and physical trauma with success.\r\n<BR><BR><B> It is best not to use Valerian root when using other sleep, antidepressant or anti-anxiety aids as it can increase the effects of them.</b>', '$7.00', 'http://jewelleesherbals.com/images/valerian.png', '0.5 oz', 'cart', '7.00', '', '', '0.03'),
(7, '1', 'Comfrey Root', 'Comfrey has tons of controversy associated with it. I love it and use it in many situations. It is against the law to sell it for internal use or for use in open wounds.  I will not be listing what I use it for and, to keep it legal, will provide a link to a study which should be read.<BR> <a href="http://www.comfreycentral.com/research/table5.htm" target="_new">Pyrrolizidine Alkaloids in Comfrey</a>', '$7.00', 'http://jewelleesherbals.com/images/comfrey.png', '0.5 oz', 'cart', '7.00', '', '', '0.03'),
(8, '1', 'Astragalus Root', 'Astragalus root is considered an adaptogen, working to balance systems in the body and having an affinity for the spleen.  It has immune enhancing effects, working directly on the bone marrows production of white blood cells.Astragalus is supportive to the lungs when used for a period of time.  It can be used internally and externally for wound healing and disinfecting. There have been no reported adverse side effects to Astragalus root.', '$7.00', 'http://jewelleesherbals.com/images/astragalus.png', '0.5 oz', 'cart', '7.00', '', '', '0.03'),
(9, '1', 'Red Clover', 'Red Clover Flower has been used as a blood purifier due to its diuretic action and coumarin content which acts as a blood thinner. It is being studied for its isoflavone constituent which can help in all sorts of hormonal imbalances and conditions secondary to those imbalances such as bone loss, uterus/prostate health, mood swings and so on.  In tincture form, I use it as a blood purifier and detoxifier, along with other herbals that help cleanse the whole body. \r\n<br><BR><b>\r\nAdverse interactions</b> to be aware of include use of blood thinning drugs in which Red Clover Flower can have an increased effect on HRT drugs (including estrogens, birth control, Tamoxifen, etc)\r\n', '$ 7.00', 'http://jewelleesherbals.com/images/redclover.png', '0.5 oz', 'cart', '7.00', '', '', '0.03'),
(10, '1', 'Chamomile', 'Chamomile is anti-inflammatory, anti-infective and anti-spasmodic. It is an anodyne, nervine, stomachic, tonic and a mild sedative.  Internally, chamomile tincture is good for any kind of digestive issue, menstrual cramps, colic in babies, and nervous or stress-related tics, headaches, trouble getting to sleep, anxiety and so on.  Chamomile is also a good herb to use for gentle detoxification with people who exhibit signs of acne, eczema, and psoriasis.  Externally, add chamomile to water or teas for a gentle face wash or soothing of skin issues such as diaper rash, eczema and even shingles. Chamomile is perfectly safe for use by the whole family except where there might be an allergy to the Asteraceae (Compositae) family.', '$5.00', 'http://jewelleesherbals.com/images/chamomile.png', '0.5 oz', 'cart', '5.00', '', '', '0.03'),
(11, '1', 'Calendula', 'Calendula is a tincture I always have with me when I go hiking or even out to the park or any other time an injury might happen.  It is antibacterial, astringent, anti-septic, immune-stimulant, vulnerary, and a vasomotor stimulant.  It also is reputed to stimulate collagen production thereby helping wounds heal and minimizing scars.  I use Calendula tincture diluted in distilled water topically on cuts, scrapes and wounds.  I also use it for internally for minor infections like colds and sore throat and so on.\r\n', '$5.00', 'http://jewelleesherbals.com/images/calendula.png', '0.5 oz', 'cart', '5.00', '', '', '0.03'),
(12, '1', 'Skullcap', 'Skullcap is an anxiolytic, anti-hypertensive, anti-spasmodic, nervine, sedative and tranquilizer (especially when mixed with certain other herbs). Skullcap is considered one of the foods for the nervous system; working on emotional issues as well as physical issues associated with the nervous system. Skullcap has been used for ailments such as tension and stress, headaches, insomnia, menstrual and digestive cramps, epilepsy and spasms of all kinds. It has also been used to help with phobias, schizophrenia, and anxiety among other things. \r\n<BR><BR><b>Possible adverse interactions</b> include increased effects of other substances that cause sedation or depression of physiological functions', '$6.00', 'http://jewelleesherbals.com/images/skullcap.png', '0.5 oz', 'cart', '6.00', '', '', '0.3'),
(13, '3', '5.0 oz Black Elderberry Syrup', 'Black Elderberry syrup is the way my children (and my mother) prefer to take Black Elderberry. They look to it in the cold months when symptoms that call for it start to creep among us.\r\n Black Elderberry is high in anthocyanins; a very important antioxidant that helps support the immune system, reduce inflammation and protect against cellular damage. Besides this, it is a mild diuretic, diaphoretic, tonic, and astringent (the latter two make it good for coughing, sore throat, gum and mouth swelling, etc).', '$8.00', '', '5.0', 'cart', '8.00', '', '', '0.15'),
(14, '3', '10 oz Black Elderberry Syrup', 'Black Elderberry syrup is the way my children (and my mother) prefer to take Black Elderberry. They look to it in the cold months when symptoms that call for it start to creep among us.\r\n Black Elderberry is high in anthocyanins; a very important antioxidant that helps support the immune system, reduce inflammation and protect against cellular damage. Besides this, it is a mild diuretic, diaphoretic, tonic, and astringent (the latter two make it good for coughing, sore throat, gum and mouth swelling, etc).', '$15.00', '', '10.0', 'cart', '15.00', '', '', '0.15'),
(15, '3', '5.0 oz Hawthorn Syrup', 'Hawthorne is considered a cardiovascular tonic. It also is high in antioxidants and is astringent, antispasmodic, sedative and stimulant.  The syrup is made with herb and berries and local raw honey.  Ask your health provider before taking if you have any cardiovascular issues and especially if you are taking Digoxin or Phenylephrine.\r\n', '$8.00', '', '5.0', 'cart', '8.00', '', '', '0.15'),
(16, '3', '10 oz Hawthorn Syrup', 'Hawthorne is considered a cardiovascular tonic. It also is high in antioxidants and is astringent, antispasmodic, sedative and stimulant.  The syrup is made with herb and berries and local raw honey.  Ask your health provider before taking if you have any cardiovascular issues and especially if you are taking Digoxin or Phenylephrine.', '$15.00', '', '10.0', 'cart', '15.00', '', '', '0.15'),
(17, '5', 'Bruise Balm', '<center><table width=95%><tr><td><font size 10pt>Use this balm for swelling, bruising, aching, joint pain, and many other conditions.<BR><BR>\r\nIngredients include Extra Virgin Olive oil, sweet Almond oil,beeswax, Shea Butter, Comfrey leaf, Arnica, white Willow bark, St Johns Wort, Lobelia and essential oils of Peru Balsam, Bay Laurel, Ginger, Nutmeg and Petitgrain. <BR><BR>\r\n<b>For topical use only. Not for use internally or on wounds where the skin has been broken.</b></td></tr></table></center>', '$12.00', 'http://jewelleesherbals.com/images/bruise.png', '4', 'cart', '12.00', '', '', '0.5'),
(18, '2', 'Mandarin Lime Chapstick', 'The Mandarin Lime Chapstick is made with Wheat Germ oil, Candelilla wax, and Coconut oil, essential oils of Lime Peel and Mandarin, and powdered Red Sandalwood.  The Wheat Germ oil is a good source for Vitamin E, essential fatty acids and anti-oxidants, all of which contribute to healthy skin.  Candelilla wax provides natural protection against moisture and some gloss and spreadability.  Coconut oil is high in fatty acids, antioxidants, Vitamin E and is a source of some minerals such as Iron.  Besides being a healthy natural addition to this chapstick, it helps improve the texture.  Red Sandalwood is considered one of the Pitta-pacifying skin rasayanas in Ayurveda, which means it draws out heat, leaving skin healthy and clear and is nourishing to sensitive skin.  The Lime Peel and Mandarin oils are both anti-septic, restorative and tonic, which means that they help the lips stay healthy and the scent combination can help lift your spirits.   \r\n', '$1.75', 'http://jewelleesherbals.com/images/chapstick.png', '.25', 'cart', '1.75', '', '', '.33'),
(19, '5', 'Scar Salve', 'This combination is for topical use on scars to help diminish them or on closed areas that there might be future scarring.\r\n<BR><BR>\r\n\r\n<B>Ingredients:</b><BR>\r\nextra virgin olive oil, coco butter, beeswax, virgin coconut oil, wheat germ oil, calendula, comfrey leaf, tamanu oil, patchouli leaf, horsetail, peru balsam, white willow bark and essential oils of ginger and patchouli.\r\n', '$ 8.00', '', '4', 'cart', '8.00', '', '', '0.5'),
(20, '5', 'Scar Salve', 'This combination is for topical use on scars to help diminish them or on closed areas that there might be future scarring.\r\n<BR><BR>\r\n\r\n<B>Ingredients:</b><BR>\r\nextra virgin olive oil, coco butter, beeswax, virgin coconut oil, wheat germ oil, calendula, comfrey leaf, tamanu oil, patchouli leaf, horsetail, peru balsam, white willow bark and essential oils of ginger and patchouli.\r\n', '$ 14.00', '', '8 oz', 'cart', '14.00', '', '', '0.5'),
(21, '5', 'Black Salve', 'This salve has powerful drawing properties.  It should be used topically on bites, scratches and anywhere there may be risk of infection.\r\n<BR><BR>\r\n\r\n<B>Ingredients:</b><BR> \r\nextra virgin olive oil, beeswax, poke root, plantain, slippery elm bark, chickweed, mullein, comfrey leaf, chaparral, goldenseal, lobelia, activated charcoal, comfrey root extract, usnea extract\r\n \r\n', '$2.50', '', '1 oz', 'cart', '2.50', '', '', '0.5'),
(22, '5', 'Black Salve', 'This salve has powerful drawing properties.  It should be used topically on bites, scratches and anywhere there may be risk of infection.\r\n<BR><BR>\r\n\r\n<B>Ingredients:</b><BR> \r\nextra virgin olive oil, beeswax, poke root, plantain, slippery elm bark, chickweed, mullein, comfrey leaf, chaparral, goldenseal, lobelia, activated charcoal, comfrey root extract, usnea extract\r\n \r\n', '$ 9.00', '', '4 oz', 'cart', '9.00', '', '', '0.5'),
(23, '1', 'Echinacea root', '', '$7.00', '', '0.5 oz', 'cart', '7.00', '', '', '0.5'),
(24, '1', 'Usnea', '', '$ 7.00', '', '0.5 oz', 'cart', '7.00', '', '', '0.5'),
(25, '1', 'Mistletoe', '', '$ 8.00', '', '0.5 oz', 'cart', '8.00', '', '', '0.5'),
(26, '1', 'Hawthorn', '', '$ 7.00', '', '0.5 oz', 'cart', '7.00', '', '', '0.5'),
(27, '1', 'Comfrey Leaf', '', '$7.00', '', '0.5 oz', 'cart', '7.00', '', '', '0.5'),
(28, '1', 'Goldenseal', '', '$ 800', '', '0.5 oz', 'cart', '8.00', '', '', '0.5'),
(29, '1', 'Hops', '', '$7.00', '', '0.5 oz', 'cart', '7.00', '', '', '0.5'),
(30, '1', 'Lobelia', '', '$ 7.00', '', '0.5 oz', 'cart', '7.00', '', '', '0.5'),
(31, '1', 'Shepards Purse', '', '$ 6.00', '', '0.5 oz', 'cart', '6.00', '', '', '0.5');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--
-- Creation: Aug 16, 2010 at 08:53 PM
-- Last update: Aug 19, 2010 at 11:03 AM
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `inquiry` text NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `name`, `email`, `phone`, `inquiry`, `notes`) VALUES
(6, 'blah', 'blah', 'blah', 'blah', 'NA'),
(5, 'blah', 'blah', 'blah', 'blah', 'NA');

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetLinks`()
BEGIN

  ##
  ## sp_AdminAccountList()
  ##
  ## Returns (account_list)

  ##
  ## Get accounts

  SELECT * FROM links;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPages`()
BEGIN

  ##
  ## sp_AdminAccountList()
  ##
  ## Returns (account_list)

  ##
  ## Get accounts

  SELECT * FROM pages;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetProductCats`()
BEGIN

  ##
  ## sp_AdminAccountList()
  ##
  ## Returns (account_list)

  ##
  ## Get accounts

  SELECT * FROM product_category;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetProducts`()
BEGIN

  ##
  ## sp_AdminAccountList()
  ##
  ## Returns (account_list)

  ##
  ## Get accounts

  SELECT * FROM products;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSubmissions`()
BEGIN

  ##
  ## sp_AdminAccountList()
  ##
  ## Returns (account_list)

  ##
  ## Get accounts

  SELECT * FROM submissions;

END$$

DELIMITER ;
