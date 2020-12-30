-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2020 at 12:17 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ohramhealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `title`, `rating`, `description`, `full_name`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `image`) VALUES
(19, 220, NULL, 100, 'I\'m into my third week of using your 14-Day teatox and i am already very happy with my results.  This tea literally removes my bloat. This is my favorite product.', '', '2020-05-10 20:15:51', '2020-05-10 20:15:51', NULL, 7, NULL),
(22, 222, NULL, 100, 'Your protein shake is so nice and super amazing, i take it for breakfast and dinner daily and it literally powers me for hours. I have lost so much weight using just the shakes. This product is a must have if you are trying to watch your daily calories.', '', '2020-05-11 17:03:42', '2020-05-11 17:03:42', NULL, 9, NULL),
(28, 217, NULL, 80, 'This coffee is one of the best purchase I’ve ever made. It works wonders and was extremely beneficial for my body. I’ve never felt so great about any weight loss product. I lost 16kg in a month. I’m still in shock. Ohram Works!', '', '2020-05-15 01:22:53', '2020-05-15 01:22:53', NULL, 12, NULL),
(29, 213, NULL, 100, 'I and my husband have been using this tea and we have lost so much weight. Trust me I’m not the type of person to order stuff online or go by stuff that people post but this tea has helped me and my husband so much with our weight loss goals! it makes me feel light and helps with the digestive system. I highly recommend this product to anyone who wants to lose weight or remove bloats. It will give you so much energy even after a workout and it’s crazy.', '', '2020-05-15 02:01:23', '2020-05-15 02:01:23', NULL, 13, NULL),
(30, 220, NULL, 100, 'Normally, I do not believe in products like this work, but I decided to try it out and I’m so happy I did. This tea will give you value for your money, I am not even joking. Apart from your slim coffee, this is my best because it flushes out everything I eat and eliminate my bloat. I legit recommend this product.', '', '2020-05-15 05:02:03', '2020-05-15 05:02:03', NULL, 14, NULL),
(31, 217, NULL, 100, 'If you are looking for a product to help you lose weight fast, Ohram slim diet coffee is what you need. This coffee will burn and dry up your fat, it also helps to curb my huge appetite for food.', '', '2020-05-15 16:07:38', '2020-05-15 16:07:38', NULL, 15, NULL),
(32, 217, NULL, 80, 'I am happy with the result i got from using your slimming coffee, keep up the good work. #bestweightlossproduct', '', '2020-05-15 21:10:18', '2020-05-15 21:10:18', NULL, 17, NULL),
(33, 221, NULL, 100, 'Hae from the UK. This pills works wonders, it curbs my appetite so well and it scares me because I am a foodie. Lolll.... This slimming pills are my favorite 👌🏻', '', '2020-05-15 21:26:41', '2020-05-15 21:26:41', NULL, 19, NULL),
(34, 220, NULL, 100, 'I ordered this tea, the protein shakes and slim diet coffee for myself and my wife two months ago from Canada. Ohram products truly works and their customer service is topnotch.', '', '2020-05-15 21:31:45', '2020-05-15 21:31:45', NULL, 18, NULL),
(35, 223, NULL, 80, 'This shakes taste so good and its really filling.', '', '2020-05-15 21:37:54', '2020-05-15 21:37:54', NULL, 20, NULL),
(36, 217, NULL, 60, 'You pple said I would burn all my tummy fat hmmm. I bought two parks and my tummy is not very flat yet. Although I lost a few pounds and have been avoiding all my eba... I hope to get the best result soon. 🚶🏿‍♂️🚶🏿‍♂️🚶🏿‍♂️🚶🏿‍♂️', '', '2020-05-15 21:44:05', '2020-05-15 21:44:05', NULL, 21, NULL),
(37, 217, NULL, 100, 'I have been on and off this product for years it is super effective, curbs my appetite and stops my cravings. If you are a coffee lover and want to lose weight this is what you should get. Good product, great taste.', '', '2020-05-15 21:50:37', '2020-05-15 21:50:37', NULL, 22, NULL),
(38, 214, NULL, 100, 'The best protein shakes. So delicious, i\'m stock with this forever!', '', '2020-05-15 22:04:56', '2020-05-15 22:04:56', NULL, 23, NULL),
(39, 215, NULL, 80, 'These capsules are magic! Been on’ em for a month now and I’m still in shock of the results! Thank u Ohram! ❤️❤️😁', '', '2020-05-15 22:11:59', '2020-05-15 22:11:59', NULL, 25, NULL),
(40, 213, NULL, 80, 'If you want to start your weekend off Right, use this product. It will melt all your tummy fat. This product is my favorite.', '', '2020-05-15 22:12:22', '2020-05-15 22:12:22', NULL, 24, NULL),
(41, 213, NULL, 100, 'I have been using this flat tummy teatox and shakes for a month now, and I am loving it. With exercising and eating right its working great.', '', '2020-05-15 22:20:04', '2020-05-15 22:20:04', NULL, 26, NULL),
(42, 221, NULL, 100, 'My journey so far on these pills have been incredible! I’ve lost 8kg so far in just a month. Amazing amazing amazing product. 😅', '', '2020-05-15 22:30:29', '2020-05-15 22:30:29', NULL, 27, NULL),
(43, 217, NULL, 100, 'No matter what way you look at it, Ohram game is pretty strong 💪🏻. They are the best in the game, great products, great customer service, and quick delivery 👍🏼👏🏼💕💕💕💕💕💕💕💕💕💕', '', '2020-05-15 22:45:20', '2020-05-15 22:45:20', NULL, 28, NULL),
(44, 220, NULL, 80, 'I\'m currently taking this tea and its already working tremendously. This teatox is everything, it cleans and detoxifies.', '', '2020-05-16 03:22:45', '2020-05-16 03:22:45', NULL, 32, NULL),
(45, 217, NULL, 100, 'The best weight loss coffee. I love the taste, and how it helps to boost my metabolism. I was introduced to it in February and I have dropped two dress sizes. This product works most especially when it’s combined with a good diet and exercise. 🔥🔥❤️❤️❤️❤️❤️👍🏽', '', '2020-05-16 21:46:56', '2020-05-16 21:46:56', NULL, 33, NULL),
(46, 217, NULL, 100, 'The best weight loss coffee. I love the taste, and how it helps to boost my metabolism. I was introduced to it in February and I have dropped two dress sizes. This product works most especially when it’s combined with a good diet and exercise. 🔥🔥❤️❤️❤️❤️❤️👍🏽', '', '2020-05-16 21:47:18', '2020-05-16 21:47:18', NULL, 33, NULL),
(54, 217, NULL, 100, 'I used the slim diet coffee and 28-Day teatox, this was my result after 2 months of taking your products. 💕 I like the way the slim diet coffee curbs my appetite, boosts my energy and stops my cravings. The teatox, on the other hand, eliminates my bloat and makes me feel good. Your products are amazing 💕👍🏻', '', '2020-05-22 19:16:30', '2020-05-22 19:16:30', NULL, 37, 'https://ohram.org/image/reviews/KpmDwATNwW58d1RCzITOO61k46a4Nl9Ezb0te1vP.png'),
(56, 217, NULL, 100, 'Your slim diet coffee is my favorite among your products. It is very effective and it gives me so much energy than I usually do. #greatproduct ❤️❤️💋', '', '2020-05-22 21:10:11', '2020-05-22 21:10:11', NULL, 39, 'https://ohram.org/image/reviews/8E3LqKl7gx6P4W1vujAEMjZZv8exlBg7PLPheikt.jpeg'),
(57, 220, NULL, 100, 'I have been using the teatox since the lockdown and I must say, it is life-changing. I love it..... ❤️❤️❤️❤️❤️ With eating right this tea works great and you will see the result in a few weeks. ☺️🥰', '', '2020-05-22 21:40:13', '2020-05-22 21:40:13', NULL, 40, 'https://ohram.org/image/reviews/50xZfq1oKc7uy58XTdV278cmfvXgASCNVGuJbbJp.png'),
(60, 220, NULL, 100, 'After working weeks with a couple of days off and overtime shifts I\'ve been eating like crap! Finally got a couple days off and I decided to try out your 14day teatox to help flush out all the junk I\'ve been eating, and the result so far has been great. ☺️❤️ The protein shakes helps to cut down my cals and I am loving it. 👏🏾👏🏾👏🏾', '', '2020-05-23 19:42:14', '2020-05-23 19:42:14', NULL, 42, 'https://ohram.org/image/reviews/mquVnrZq5f1QEJvvt1ke7PTIR45yRg7tHekxEM0P.jpeg'),
(61, 217, NULL, 100, 'I ordered your slim diet coffee from Canada and got my package really fast! 👏🏼 Today is the 13th day I have been dedicated to taking the coffee and also eating clean, that is my result 👆🏼👆🏼👆🏼👆🏼👆🏼 Just look at my arm 💃🏻💃🏻. My target is size 10-12 and I am gradually reaching my goals with your coffee 🥰🥰🥰🥰🥰🥰🥰🥰  @calme_meme', '', '2020-05-25 23:10:20', '2020-05-25 23:10:20', NULL, 44, 'https://ohram.org/image/reviews/4CqrNvUusgLmaJDji8YH6tgOdxUdcl1lUWpaSEce.png'),
(62, 217, NULL, 100, 'This product is effective, it curbs my appetite and stops my cravings. Definitely the best weightloss tea.', '', '2020-05-26 01:37:38', '2020-05-26 01:37:38', NULL, 46, NULL),
(63, 213, NULL, 100, 'I got started on the 28day flat tummy teatox because I needed to lose my postpartum weight and be snatched. The waist trainer also helped in getting my waistline snatched 😁  Honestly, I was hesitant the first time I saw one of your posts on Instagram because I\'ve used different weight loss teas that never worked. I decided to be optimistic and try it out and it worked. 👍🏽', '', '2020-05-27 02:26:02', '2020-05-27 02:26:02', NULL, 47, 'https://ohram.org/image/reviews/0bmNtokbQMU0lfugPsyHsn5IZS0SiWkJsaXjcaGq.jpeg'),
(64, 217, NULL, 100, 'If you are looking for a product to help you lose weight, this product is what you need. I have used this product and I also sold to so many people. I have sooooo many reviews on my Instagram page @chebeempire from when I sold your products. Ohram is a great product and I highly recommend it. 👌🏾', '', '2020-05-28 15:27:27', '2020-05-28 15:27:27', NULL, 49, 'https://ohram.org/image/reviews/WT0RMTsaeLqWF84aEuM6GJDUUXC3NpBMMm4gfz27.jpeg'),
(65, 220, NULL, 100, 'My kids introduced me to this product and it helped me with my bloating. I take it before bed.', '', '2020-05-28 15:46:40', '2020-05-28 15:46:40', NULL, 50, 'https://ohram.org/image/reviews/PlGBwYJBhJiIdT0XbFMxbxaPfmHjHoEu5kb4QbLw.jpeg'),
(66, 223, NULL, 100, 'What better meal can I have after an intermittent fasting 👀 @ohramofficial got me with their yummy vanilla shakes for my bowl of whole-grain oat! this shake is everything to get that Belly filled up without staying hungry. 💕 💕💕💕💕💕💕💕💕', '', '2020-05-28 20:27:09', '2020-05-28 20:27:09', NULL, 51, 'https://ohram.org/image/reviews/CpCdmgKo7lGA3NFPc2jtbzI6kwcZ1EuKz73Xuhvb.jpeg'),
(67, 215, NULL, 100, 'The proof is in the results, my tummy is flatter, my thighs are now slimmer and my clothes are definitely looser. I’ve used Ohram products several times, and I’m really happy with the Progress. These capsules suppresses appetite and i recommend it.', '', '2020-05-29 17:51:33', '2020-05-29 17:51:33', NULL, 54, NULL),
(68, 217, NULL, 100, '@ritabenson9260 ” This coffee does everything it says it does. I drink it every morning before breakfast and it helps me start my day on the right foot. It gives me the push I need to get on top of my health. They sold out in the U.S so I ordered from Nigeria so I don\'t run out. Thank you Ohram. 👍🏾🖤🖤😘😘😘😘😘😘😘', '', '2020-06-01 01:34:08', '2020-06-01 01:34:08', NULL, 61, 'https://ohram.org/image/reviews/fyllDVgDw1e7zG2jqPNNwWbltRvOnM0nxglM0a2k.jpeg'),
(69, 214, NULL, 100, 'Ohram meal replacement strawberry shake is so delicious and it tastes like a dream, I can\'t get enough of it. The shake has helped me stop snacking junks throughout the day because it\'s so filling. Honestly, I cannot speak more highly about your products, they are effective. ❤️❤️❤️❤️', '', '2020-06-03 22:33:58', '2020-06-03 22:33:58', NULL, 68, 'https://ohram.org/image/reviews/20UYgb8PIOrJy9xqS2HBfykxVGG31Kpp7nIrRodf.jpeg'),
(70, 220, NULL, 100, 'This tea makes me feel a lot lighter honestly and DO NOT eat again after taking it at night. It literally melts away my tummy bloat and it makes me feel fierce, fit and strong. I absolutely love this product 👄💜💜🧡🔥🔥🔥🔥🔥🔥🔥', '', '2020-06-08 08:52:05', '2020-06-08 08:52:05', NULL, 79, 'https://ohram.org/image/reviews/vgrTmFlK9PrVJY0vOkglQJm5tJ9zxOtoj0sdYFsy.jpeg'),
(71, 236, NULL, 100, 'I LOVE this shake, especially the strawberry flavor. It’s perfect for me, since I typically have super early mornings it helps me maintain a healthy diet. The shake bottle come in handy for mixing. I just add my scoops, cold milk/milk with ice and I’m out the door!', '', '2020-06-13 16:22:26', '2020-06-13 16:22:26', NULL, 85, NULL),
(72, 213, NULL, 100, 'I’m still on my journey with the tea and coffee I got from u. I was about 92kg when I started, I checked my weight last week I was weighing 86.4kg. I couldn\'t stop screaming out of excitement 🤣🤣 Thank you so much your products are really effective 😁 💃🏽', '', '2020-06-15 23:39:41', '2020-06-15 23:39:41', NULL, 86, 'https://ohram.org/image/reviews/QxrlDUDCUog0CdzwoeVORRTFatu1FIGm9ledm8lG.jpeg'),
(74, 220, NULL, 100, 'So far, I have lost 14lbs using the 14 Day teatox and healthy meal replacement protein shake. I would highly recommend Ohram products, they work!!', '', '2020-07-01 20:51:14', '2020-07-01 20:51:14', NULL, 101, 'https://ohram.org/image/reviews/rAXRZHAnPQTgTKkcA703EdIMhwf5qqkcDY7l9UUg.jpeg'),
(75, 240, NULL, 100, 'Great infuser..... 👌🏾👌🏾🖤\r\nI bought this to infuse tea at work. It is very light to use. I carry it to the break room, back to my desk. To meetings, etc. The tea basket is super easy to use. It keeps my tea hot for hours (I would make a cup of tea at 7 am and it stays hot till after work) I did a price check with other brands and Ohram has the best price for the the quality they offer. I also love the fact that it tells the temperature 👌🏾 😁😁 I am obsessed with this tea infuser 👌🏾', '', '2020-07-26 19:44:58', '2020-07-26 19:44:58', NULL, 109, 'https://ohram.org/image/reviews/fnThFzPhQfI7VxVnoqqVFX3q0A05E8lr5vqYZAsS.jpeg'),
(76, 237, NULL, 100, 'I am never one to leave a review, but this Ohram waist trainer is WORTH IT! I bought mine a few months ago, and never really used it for no other reason, I just didn\'t. I kept it in a drawer, like everything else, and \"out of sight, out of mind.\" Well, a a month ago, I decided to start wearing it and I was dedicated. Let me tell you...… IT WORKS! I ordered an XL, I just placed an order for a Large because my waist is now smaller. I am very pleased!! 👍🏾', '', '2020-08-24 22:57:07', '2020-08-24 22:57:07', NULL, 115, 'https://ohram.org/images/reviews/JY9vkCcawl9bGlVvDdpR4YyNa2erptvtM4fiFwgI.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
