CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_alias_unique` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `categories` (`id`, `parent_id`, `alias`, `img`, `created_at`, `updated_at`) VALUES
(32, 0, 'blog', 0, '2018-07-23 12:39:30', '2018-07-23 12:39:30'),
(33, 32, 'under-blog', 0, '2018-07-25 14:39:59', '2018-07-25 14:39:59'),
(34, 35, 'about', 0, '2018-07-25 14:59:29', '2018-07-31 10:11:21'),
(35, 0, 'car-service', 0, '2018-07-25 14:59:43', '2018-07-25 14:59:43'),
(36, 0, 'bmw', 0, '2018-07-31 13:53:18', '2018-07-31 13:53:18');

CREATE TABLE IF NOT EXISTS `category_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_translations_category_id_locale_unique` (`category_id`,`locale`),
  KEY `category_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `category_translations` (`id`, `category_id`, `title`, `keywords`, `description`, `locale`, `created_at`, `updated_at`) VALUES
(8, 32, 'Blog', '', '', 'en', '2018-07-23 12:39:30', '2018-07-23 12:39:30'),
(9, 33, 'under blog', '', '', 'en', '2018-07-25 14:40:00', '2018-07-25 14:40:00'),
(10, 34, 'About', '', '', 'en', '2018-07-25 14:59:29', '2018-07-25 14:59:29'),
(11, 35, 'CAR SERVICE', '', '', 'en', '2018-07-25 14:59:43', '2018-07-25 14:59:43'),
(12, 36, 'bmw', '', '', 'en', '2018-07-31 13:53:18', '2018-07-31 13:53:18'),
(13, 32, 'Блог', '', '', 'ru', '2018-08-02 09:58:27', '2018-08-02 09:58:27');



CREATE TABLE IF NOT EXISTS `ec_bookings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `PickingUpDate` bigint(20) NOT NULL,
  `DroppingOffDate` bigint(20) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ec_bookings_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_bookings` (`id`, `order_id`, `product_id`, `PickingUpDate`, `DroppingOffDate`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 14, 1, 1539156600, 1539177300, 1, NULL, NULL),
(2, 15, 1, 1539237600, 1539324000, 1, NULL, NULL),
(3, 16, 1, 1539151200, 1539324000, 1, NULL, NULL),
(4, 17, 1, 1539324000, 1539410400, 1, NULL, NULL),
(5, 18, 1, 1539324000, 1539410400, 1, NULL, NULL),
(6, 19, 1, 1539324000, 1539410400, 1, NULL, NULL),
(7, 20, 1, 1539324000, 1539410400, 1, NULL, NULL),
(8, 21, 1, 1539324000, 1539410400, 1, NULL, NULL),
(9, 22, 8, 1545638400, 1546416000, NULL, NULL, NULL),
(10, 23, 4, 1547103600, 1547103600, 1, NULL, NULL),
(11, 24, 1, 1547190000, 1547276400, 1, NULL, NULL),
(12, 25, 1, 1547276400, 1547276400, 1, NULL, NULL),
(13, 26, 1, 1547103600, 1547103600, 1, NULL, NULL),
(14, 27, 1, 1547103600, 1547103600, 1, NULL, NULL),
(15, 28, 1, 1547103600, 1547103600, 1, NULL, NULL),
(16, 29, 1, 1547103600, 1547103600, 1, NULL, NULL),
(17, 30, 1, 1547103600, 1547103600, 1, NULL, NULL),
(18, 31, 1, 1547276400, 1547276400, 1, NULL, NULL),
(19, 32, 1, 1547276400, 1547276400, 1, NULL, NULL),
(20, 33, 1, 1547276400, 1547276400, 1, NULL, NULL),
(21, 34, 1, 1547276400, 1547276400, 1, NULL, NULL),
(22, 35, 1, 1547449200, 1547449200, 1, NULL, NULL),
(23, 36, 4, 1547103600, 1548486000, 1, NULL, NULL),
(24, 37, 4, 1548486000, 1548658800, 1, NULL, NULL),
(25, 38, 4, 1548658800, 1549004400, 1, NULL, NULL);

CREATE TABLE IF NOT EXISTS `ec_locations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `ec_locations_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_locations` (`id`, `alias`, `created_at`, `updated_at`, `user_id`) VALUES
(4, 'airport', '2018-08-23 10:56:30', '2018-08-23 10:56:30', 1),
(5, 'paphos', '2018-08-23 11:07:25', '2018-08-23 11:07:25', 1),
(6, 'nicosia', '2018-08-23 11:07:31', '2018-08-23 11:07:31', 1),
(7, 'larnaca', '2018-08-23 11:07:40', '2018-08-23 11:07:40', 1),
(8, 'limassol', '2018-08-23 11:07:46', '2018-08-23 11:07:46', 1),
(9, 'kyrenia', '2018-08-23 11:07:51', '2018-08-23 11:07:51', 1),
(10, 'famagusta', '2018-08-23 11:07:57', '2018-08-23 11:07:57', 1);

CREATE TABLE IF NOT EXISTS `ec_location_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ec_location_translations_location_id_locale_unique` (`location_id`,`locale`),
  KEY `ec_location_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_location_translations` (`id`, `location_id`, `title`, `locale`, `created_at`, `updated_at`) VALUES
(2, 4, 'Airport', 'en', '2018-08-23 10:56:30', '2018-08-23 10:56:30'),
(3, 5, 'Paphos', 'en', '2018-08-23 11:07:25', '2018-08-23 11:07:25'),
(4, 6, 'Nicosia', 'en', '2018-08-23 11:07:31', '2018-08-23 11:07:31'),
(5, 7, 'Larnaca', 'en', '2018-08-23 11:07:40', '2018-08-23 11:07:40'),
(6, 8, 'Limassol', 'en', '2018-08-23 11:07:46', '2018-08-23 11:07:46'),
(7, 9, 'Kyrenia', 'en', '2018-08-23 11:07:51', '2018-08-23 11:07:51'),
(8, 10, 'Famagusta', 'en', '2018-08-23 11:07:57', '2018-08-23 11:07:57'),
(9, 10, 'Фамагуста', 'ru', '2018-08-24 04:39:46', '2018-08-24 04:39:46');


CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_alias_unique` (`alias`),
  KEY `posts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `posts` (`id`, `alias`, `status`, `img`, `user_id`, `deleted_at`, `created_at`, `updated_at`, `published_at`) VALUES
(1, 'test-post', 'published', '', 1, '2018-10-10 05:22:56', '2018-06-01 14:03:03', '2018-10-10 05:22:56', '2018-06-03'),
(2, 'sample-post-with-featured-image', 'published', '11', 1, '2018-11-30 15:43:14', '2018-07-23 12:04:46', '2018-11-30 15:43:14', '2018-07-23'),
(3, 'standard-blog-post-with-image-slider-header', 'published', '54', 1, NULL, '2018-07-23 12:10:24', '2019-01-15 12:50:03', '2018-07-23'),
(4, 'sdfsdfsfsf', 'published', '', 1, '2018-07-23 12:26:10', '2018-07-23 12:21:01', '2018-07-23 12:26:10', '2018-07-23'),
(5, 'standard-video-blog-post-header', 'published', '8', 1, NULL, '2018-07-23 12:25:47', '2018-07-23 12:39:54', '2018-07-23'),
(7, 'tedsfsd-fpost', 'published', '13', 1, '2018-10-10 05:22:53', '2018-07-27 17:58:01', '2018-10-10 05:22:53', '2018-07-27'),
(8, 'dgsdfgds', 'published', '', 1, '2018-10-18 12:40:39', '2018-10-16 14:40:29', '2018-10-18 12:40:39', '2018-10-16'),
(9, 'asdfasd', 'published', '', 1, '2018-10-18 12:40:43', '2018-10-16 14:41:41', '2018-10-18 12:40:43', '2018-10-16'),
(10, 'tyui', 'published', '', 1, '2018-10-18 12:40:45', '2018-10-16 14:42:59', '2018-10-18 12:40:45', '2018-10-16'),
(11, 'toyota-corolla-1-6-elegant', 'published', '', 1, '2018-10-18 12:40:48', '2018-10-16 14:43:49', '2018-10-18 12:40:48', '2018-10-16'),
(12, 'standard-blog-post-with-image-slider-header-1', 'published', '64', 1, NULL, '2019-01-15 12:42:46', '2019-01-15 12:49:48', '2019-01-15'),
(13, 'standard-blog-post-with-image-slider-header-2', 'published', '19', 1, NULL, '2019-01-15 12:42:47', '2019-01-15 12:50:21', '2019-01-15'),
(14, 'standard-blog-post-with-image-slider-header-3', 'published', '7', 1, NULL, '2019-01-15 12:42:48', '2019-01-15 12:42:48', '2019-01-15'),
(15, 'standard-blog-post-with-image-slider-header-4', 'published', '7', 1, NULL, '2019-01-15 12:42:48', '2019-01-15 12:42:48', '2019-01-15'),
(16, 'standard-blog-post-with-image-slider-header-5', 'published', '40', 1, NULL, '2019-01-15 12:42:49', '2019-01-16 07:56:20', '2019-01-15');

CREATE TABLE IF NOT EXISTS `post_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_translations_post_id_locale_unique` (`post_id`,`locale`),
  KEY `post_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `post_translations` (`id`, `post_id`, `title`, `text`, `desc`, `keywords`, `meta_desc`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'test post2', '<p><strong>fghjghj<iframe src=\"//www.youtube.com/embed/5i1DN9YAmnQ\" width=\"854\" height=\"480\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></strong></p>', 'ghjdghjdfghj', '', 'ghjghj', 'en', '2018-07-09 14:03:03', '2018-07-10 17:54:10'),
(2, 1, 'Первый пост', '<p><strong>fghjghjапап<iframe src=\"//www.youtube.com/embed/5i1DN9YAmnQ\" width=\"854\" height=\"480\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></strong></p>', 'првыпывап', '', 'ароапро 1', 'ru', '2018-07-10 08:26:29', '2018-07-10 08:42:26'),
(3, 2, 'Sample Post With Featured Image', '<article class=\"post-wrap\">\r\n<div class=\"post-body\">\r\n<div class=\"post-excerpt\">\r\n<p class=\"text-xl\">Nulla vitae elit libero, a pharetra augue. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna,...</p>\r\n<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>\r\n<p>Donec ullamcorper nulla non metus auctor fringilla. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta gravida at eget metus. Sed posuere consectetur est at lobortis. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>\r\n<blockquote>\r\n<h4>Fusce gravida interdum eros a mollis.</h4>\r\n<p>Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel.</p>\r\n</blockquote>\r\n<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>\r\n</div>\r\n</div>\r\n</article>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', '', 'Fusce gravida interdum eros a mollis', 'en', '2018-07-23 12:04:46', '2018-10-12 09:04:30'),
(4, 3, 'Standard Blog Post with Image Slider Header', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', 'keys 1', 'Fusce gravida interdum erosdfsdfsdfkhgjkhgjk', 'en', '2018-07-23 12:10:24', '2018-12-14 15:31:38'),
(5, 4, 'sdfsdfsfsf', '<p>sdfsdfsdf</p>', 'sdfsdf', '', 'fghfgh', 'en', '2018-07-23 12:21:01', '2018-07-23 12:21:01'),
(6, 5, 'Standard Video Blog Post Header', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', '', 'sdfsdf', 'en', '2018-07-23 12:25:47', '2018-07-23 12:25:47'),
(7, 5, 'Видео блог пост', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', '', 'sdfsdf', 'ru', '2018-07-23 18:06:30', '2018-07-23 18:06:30'),
(8, 7, 'tedsfsd fpost', '<p>sdfsdf</p>', 'sdfsdfsdf', '', 'sfsdf', 'en', '2018-07-27 17:58:01', '2018-07-27 17:58:01'),
(9, 7, 'Пример поста', '<p>sdfsdf</p>', 'sdfsdfsdf', '', 'sfsdf', 'ru', '2018-08-29 09:05:43', '2018-08-29 09:05:43'),
(10, 8, 'test', '<p>dfgsdfg</p>', 'fgsdfg', 'fghjhgj', 'ghjgfhj', 'en', '2018-10-16 14:40:29', '2018-10-16 14:40:29'),
(11, 9, 'sdfsdaf', '<p>sdfsadf</p>', 'fasdf', 'asdfa', 'sadfasdf', 'en', '2018-10-16 14:41:41', '2018-10-16 14:41:41'),
(12, 10, 'ytuyti', '<p>uirytui</p>', 'tyiutyui', 'tyui', 'tyui', 'en', '2018-10-16 14:42:59', '2018-10-16 14:42:59'),
(13, 11, 'Sidebar menukjl', '<p>kjggjhk</p>', 'jhkljkl', 'ghjk', 'hjk', 'en', '2018-10-16 14:43:49', '2018-10-16 14:43:49'),
(14, 12, 'Standard Blog Post with Image Slider Header 1', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', 'keys 1', 'Fusce gravida interdum erosdfsdfsdfkhgjkhgjk', 'en', '2019-01-15 12:42:46', '2019-01-15 12:42:46'),
(15, 13, 'Standard Blog Post with Image Slider Header 1 1', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', 'keys 1', 'Fusce gravida interdum erosdfsdfsdfkhgjkhgjk', 'en', '2019-01-15 12:42:47', '2019-01-15 12:42:47'),
(16, 14, 'Standard Blog Post with Image Slider Header 1 1 1', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', 'keys 1', 'Fusce gravida interdum erosdfsdfsdfkhgjkhgjk', 'en', '2019-01-15 12:42:48', '2019-01-15 12:42:48'),
(17, 15, 'Standard Blog Post with Image Slider Header 1 1 1 1', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', 'keys 1', 'Fusce gravida interdum erosdfsdfsdfkhgjkhgjk', 'en', '2019-01-15 12:42:48', '2019-01-15 12:42:48'),
(18, 16, 'Standard Blog Post with Image Slider Header 1 1 1 1 1', '<p>Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...</p>', 'Fusce gravida interdum eros a mollis. Sed non lorem varius, volutpat nisl in, laoreet ante. Quisque suscipit mauris ipsum, eu mollis arcu laoreet vel. In posuere odio sed libero tincidunt commodo a vel ipsum. Mauris fringilla tellus aliquam, egestas sem in, malesuada nunc. Etiam condimentum felis odio, vel mollis est tempor non...', 'keys 1', 'Fusce gravida interdum erosdfsdfsdfkhgjkhgjk', 'en', '2019-01-15 12:42:49', '2019-01-15 12:42:49');


CREATE TABLE IF NOT EXISTS `category_post` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_post_category_id_foreign` (`category_id`),
  KEY `category_post_post_id_foreign` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `category_post` (`id`, `category_id`, `post_id`, `created_at`, `updated_at`) VALUES
(35, 32, 2, NULL, NULL),
(36, 32, 3, NULL, NULL),
(37, 32, 5, NULL, NULL),
(38, 33, 2, NULL, NULL),
(39, 33, 3, NULL, NULL),
(40, 34, 3, NULL, NULL),
(41, 33, 9, NULL, NULL),
(42, 33, 10, NULL, NULL),
(43, 35, 10, NULL, NULL),
(44, 33, 11, NULL, NULL),
(45, 35, 11, NULL, NULL),
(46, 36, 11, NULL, NULL),
(47, 32, 12, NULL, NULL),
(48, 33, 12, NULL, NULL),
(49, 34, 12, NULL, NULL),
(53, 32, 14, NULL, NULL),
(54, 33, 14, NULL, NULL),
(55, 34, 14, NULL, NULL),
(56, 32, 15, NULL, NULL),
(57, 33, 15, NULL, NULL),
(58, 34, 15, NULL, NULL),
(61, 34, 16, NULL, NULL),
(62, 35, 13, NULL, NULL),
(63, 36, 13, NULL, NULL),
(64, 35, 16, NULL, NULL),
(65, 36, 16, NULL, NULL);


CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_post_id_foreign` (`post_id`),
  KEY `comments_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `comments` (`id`, `text`, `name`, `email`, `site`, `parent_id`, `post_id`, `status`, `locale`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'yjtyjtyj', 'namee', 'email', 'site', 0, 5, 'published', 'en', 1, NULL, '2018-07-23 18:28:41', '2018-07-23 18:28:41'),
(2, 'тест', 'Виктор', '1@gmail.com', '', 0, 5, 'published', 'ru', 1, NULL, '2018-07-23 18:34:47', '2018-07-23 18:34:47'),
(3, '33333333333333', 'Виктор', '1@gmail.com', '', 2, 5, 'published', 'en', 1, NULL, '2018-07-23 18:51:52', '2018-07-23 18:51:52'),
(4, '44444444444444444444444', 'Виктор', '1@gmail.com', '', 0, 5, 'published', 'en', 1, NULL, '2018-07-23 19:05:02', '2018-07-23 19:05:02'),
(5, 'yjghjghjgfjhgfjhgfjgfhj', 'Виктор', '1@gmail.com', '', 0, 5, 'published', 'en', 1, NULL, '2018-07-25 08:48:43', '2018-07-25 08:48:43'),
(6, 'fghdfghfgdh', 'Sasha Burgering', '1@gmail.com', '', 0, 5, '', 'en', NULL, NULL, '2018-07-25 08:50:45', '2018-07-25 08:50:45'),
(7, 'admin test', 'Виктор', '1@gmail.com', '', 0, 5, 'published', 'en', 1, NULL, '2018-07-25 09:18:43', '2018-07-25 09:18:43'),
(8, 'кацап текст', 'Виктор', '1@gmail.com', '', 0, 5, 'published', 'ru', 1, NULL, '2018-07-25 13:09:29', '2018-07-25 13:09:29'),
(9, 'en text', 'Виктор', '1@gmail.com', '', 0, 5, 'published', 'en', 1, NULL, '2018-07-25 13:09:58', '2018-07-25 13:09:58'),
(10, 'pppppp', 'Виктор', '1@gmail.com', '', 0, 5, 'published', 'en', 1, NULL, '2018-07-25 13:40:15', '2018-07-25 13:40:15'),
(11, 'fghfgh', 'Виктор', '1@gmail.com', '', 0, 3, 'published', 'en', 1, NULL, '2018-08-22 09:12:58', '2018-08-22 09:12:58');

CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double(8,2) DEFAULT NULL,
  `meta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`),
  KEY `coupons_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `coupons` (`id`, `code`, `type`, `value`, `meta`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'code2019', 'percent', 10.00, NULL, 3, '2019-01-11 11:02:16', '2019-01-11 11:02:16');

CREATE TABLE IF NOT EXISTS `ec_orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(13,2) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `discount` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ec_orders_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_orders` (`id`, `gender`, `name`, `email`, `phone`, `street_address`, `payment`, `status`, `total_price`, `message`, `ip`, `user_id`, `created_at`, `updated_at`, `coupon_id`, `discount`) VALUES
(1, 'Mr', 'Sasha Burgering', '1@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'paid', '100.00', '', '127.0.0.1', 1, '2018-09-10 09:41:00', '2018-09-10 09:41:00', NULL, NULL),
(2, 'Mr', 'Sasha Burgering', '1@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'paid', '100.00', '', '127.0.0.1', 1, '2018-09-10 09:41:11', '2018-09-10 09:41:11', NULL, NULL),
(3, 'Mr', 'Sasha Burgering', '1@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-10 10:03:05', '2018-09-10 10:03:05', NULL, NULL),
(4, 'Mr', 'Sasha Burgering', 'leonn366@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-10 10:18:54', '2018-09-10 10:18:54', NULL, NULL),
(5, 'Mr', 'Sasha Burgering', 'leonn366@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-10 10:23:25', '2018-09-10 10:23:25', NULL, NULL),
(6, 'Mr', 'Sasha Burgering', 'leonn366@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-10 10:25:12', '2018-09-10 10:25:12', NULL, NULL),
(7, 'Mr', 'Sasha Burgering', 'leonn366@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-10 10:26:42', '2018-09-10 10:26:42', NULL, NULL),
(8, 'Mr', 'Sasha Burgering', 'leonn366@gmail.com', '3997636555', 'washington, washington, washington', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-10 10:28:50', '2018-09-10 10:28:50', NULL, NULL),
(9, 'Mr', 'Sasha Burgering', 'leonn366@gmail.com', '3997636555', 'washington, washington, washington', 'stripe', 'paid', '100.00', '', '127.0.0.1', 1, '2018-09-10 11:06:13', '2018-09-10 11:06:13', NULL, NULL),
(10, 'Mr', 'Sasha Burgering', 'leonn366@gmail.com', '3997636555', 'washington, washington, washington', 'stripe', 'paid', '100.00', 'jkljkl', '127.0.0.1', 1, '2018-09-11 08:51:40', '2018-09-11 08:51:40', NULL, NULL),
(11, 'Ms', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'cheque', 'pending', '100.00', 'uioyuiouyio', '127.0.0.1', 1, '2018-09-19 09:15:19', '2018-09-19 09:15:19', NULL, NULL),
(12, 'Mr', 'Виктор Лернер', 'admin@trtermail.ru', '381541', 'Запорожье', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-19 14:46:07', '2018-09-19 14:46:07', NULL, NULL),
(13, 'Ms', 'Виктор Лернер', 'admin@trtermail.ru', '381541', 'Запорожье', 'cheque', 'pending', '100.00', '', '127.0.0.1', 1, '2018-09-19 15:31:52', '2018-09-19 15:31:52', NULL, NULL),
(14, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'jkljkl', '127.0.0.1', 1, '2018-10-10 13:26:35', '2018-10-10 13:26:35', NULL, NULL),
(15, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'jil', '127.0.0.1', 1, '2018-10-10 13:42:57', '2018-10-10 13:42:57', NULL, NULL),
(16, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'hgjk', '127.0.0.1', 1, '2018-10-10 14:29:19', '2018-10-10 14:29:19', NULL, NULL),
(17, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'hgjk', '127.0.0.1', 1, '2018-10-10 14:30:32', '2018-10-10 14:30:32', NULL, NULL),
(18, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'hgjk', '127.0.0.1', 1, '2018-10-10 14:30:54', '2018-10-10 14:30:54', NULL, NULL),
(19, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'hgjk', '127.0.0.1', 1, '2018-10-10 14:31:06', '2018-10-10 14:31:06', NULL, NULL),
(20, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'hgjk', '127.0.0.1', 1, '2018-10-10 14:37:12', '2018-10-10 14:37:12', NULL, NULL),
(21, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington', 'cheque', 'pending', '100.00', 'hgjk', '127.0.0.1', 1, '2018-10-10 14:37:22', '2018-10-10 14:37:22', NULL, NULL),
(22, 'Mr', 'Vitor Pereira', 'vitorhfpereira@hotmail.com', '961454922', 'Rua da Alegria', 'cheque', 'pending', '100.00', 'testing', '62.28.121.110', NULL, '2018-12-23 14:30:11', '2018-12-23 14:30:11', NULL, NULL),
(23, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'pending', '59.00', '', '212.8.51.44', 1, '2019-01-10 12:15:37', '2019-01-10 12:15:37', NULL, NULL),
(24, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'paid', '2.00', '', '212.8.51.44', 1, '2019-01-10 12:31:39', '2019-01-10 12:33:25', NULL, NULL),
(25, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'paid', '2.00', '', '212.8.51.44', 1, '2019-01-10 13:00:58', '2019-01-10 13:44:45', NULL, NULL),
(26, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'paid', '2.00', '', '212.8.51.44', 1, '2019-01-10 15:44:28', '2019-01-10 16:29:03', NULL, NULL),
(27, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 15:48:46', '2019-01-10 15:48:46', NULL, NULL),
(28, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 15:49:14', '2019-01-10 15:49:14', NULL, NULL),
(29, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 15:49:30', '2019-01-10 15:49:30', NULL, NULL),
(30, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 15:49:52', '2019-01-10 15:49:52', NULL, NULL),
(31, 'Mr', 'Bob barker', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'paid', '2.00', '', '212.8.51.44', 1, '2019-01-10 16:00:57', '2019-01-10 16:44:33', NULL, NULL),
(32, 'Mr', 'Bob barker', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 16:04:31', '2019-01-10 16:04:31', NULL, NULL),
(33, 'Mr', 'Виктор Лернер', 'admin@trtermail.ru', '381541', 'Запорожье', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 16:05:32', '2019-01-10 16:05:32', NULL, NULL),
(34, 'Mr', 'Виктор Лернер', 'admin@trtermail.ru', '381541', 'Запорожье', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 16:05:59', '2019-01-10 16:05:59', NULL, NULL),
(35, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'paid', '2.00', '', '212.8.51.44', 1, '2019-01-10 16:08:40', '2019-01-10 16:53:44', NULL, NULL),
(36, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'paid', '16.00', '', '212.8.51.44', 1, '2019-01-10 17:19:13', '2019-01-10 17:30:51', NULL, NULL),
(37, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'pending', '2.00', '', '212.8.51.44', 1, '2019-01-10 19:13:08', '2019-01-10 19:13:08', NULL, NULL),
(38, 'Mr', 'Sasha Burgering', 'admin@trtermail.ru', '381541', 'washington, washington, washington', 'PayPal', 'completed', '4.00', '', '212.8.51.44', 1, '2019-01-10 19:14:02', '2019-01-11 11:18:10', NULL, NULL);

CREATE TABLE IF NOT EXISTS `ec_order_items` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ec_order_items_order_id_foreign` (`order_id`),
  KEY `ec_order_items_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_order_items` (`id`, `quantity`, `price`, `sku`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, '55.00', '122', 1, 1, '2018-09-10 09:41:00', '2018-09-10 09:41:00'),
(2, 1, '55.00', '122', 2, 1, '2018-09-10 09:41:11', '2018-09-10 09:41:11'),
(3, 1, '80.00', '122', 3, 1, '2018-09-10 10:03:05', '2018-09-10 10:03:05'),
(4, 1, '825.00', '', 4, 1, '2018-09-10 10:18:54', '2018-09-10 10:18:54'),
(5, 1, '600.00', '', 5, 1, '2018-09-10 10:23:25', '2018-09-10 10:23:25'),
(6, 1, '500.00', '', 6, 1, '2018-09-10 10:25:12', '2018-09-10 10:25:12'),
(7, 1, '525.00', '', 7, 1, '2018-09-10 10:26:42', '2018-09-10 10:26:42'),
(8, 1, '525.00', '', 8, 1, '2018-09-10 10:28:50', '2018-09-10 10:28:50'),
(9, 1, '120.00', '', 9, 1, '2018-09-10 11:06:13', '2018-09-10 11:06:13'),
(10, 1, '110.00', '', 10, 1, '2018-09-11 08:51:40', '2018-09-11 08:51:40'),
(11, 1, '220.00', '', 11, 9, '2018-09-19 09:15:19', '2018-09-19 09:15:19'),
(12, 1, '140.00', '', 12, 9, '2018-09-19 14:46:08', '2018-09-19 14:46:08'),
(13, 1, '110.00', '', 13, 8, '2018-09-19 15:31:52', '2018-09-19 15:31:52'),
(14, 1, '90.00', '', 14, 1, '2018-10-10 13:26:35', '2018-10-10 13:26:35'),
(15, 1, '90.00', '', 15, 1, '2018-10-10 13:42:57', '2018-10-10 13:42:57'),
(16, 1, '130.00', '', 16, 1, '2018-10-10 14:29:19', '2018-10-10 14:29:19'),
(17, 1, '75.30', '', 17, 1, '2018-10-10 14:30:32', '2018-10-10 14:30:32'),
(18, 1, '75.30', '', 18, 1, '2018-10-10 14:30:54', '2018-10-10 14:30:54'),
(19, 1, '75.30', '', 19, 1, '2018-10-10 14:31:06', '2018-10-10 14:31:06'),
(20, 1, '75.30', '', 20, 1, '2018-10-10 14:37:12', '2018-10-10 14:37:12'),
(21, 1, '75.30', '', 21, 1, '2018-10-10 14:37:22', '2018-10-10 14:37:22'),
(22, 1, '90.00', '', 22, 8, '2018-12-23 14:30:11', '2018-12-23 14:30:11'),
(23, 1, '59.00', '', 23, 4, '2019-01-10 12:15:37', '2019-01-10 12:15:37'),
(24, 1, '2.00', '', 24, 1, '2019-01-10 12:31:39', '2019-01-10 12:31:39'),
(25, 1, '2.00', '', 25, 1, '2019-01-10 13:00:58', '2019-01-10 13:00:58'),
(26, 1, '2.00', '', 26, 1, '2019-01-10 15:44:28', '2019-01-10 15:44:28'),
(27, 1, '2.00', '', 27, 1, '2019-01-10 15:48:46', '2019-01-10 15:48:46'),
(28, 1, '2.00', '', 28, 1, '2019-01-10 15:49:14', '2019-01-10 15:49:14'),
(29, 1, '2.00', '', 29, 1, '2019-01-10 15:49:30', '2019-01-10 15:49:30'),
(30, 1, '2.00', '', 30, 1, '2019-01-10 15:49:52', '2019-01-10 15:49:52'),
(31, 1, '2.00', '', 31, 1, '2019-01-10 16:00:57', '2019-01-10 16:00:57'),
(32, 1, '2.00', '', 32, 1, '2019-01-10 16:04:31', '2019-01-10 16:04:31'),
(33, 1, '2.00', '', 33, 1, '2019-01-10 16:05:32', '2019-01-10 16:05:32'),
(34, 1, '2.00', '', 34, 1, '2019-01-10 16:05:59', '2019-01-10 16:05:59'),
(35, 1, '2.00', '', 35, 1, '2019-01-10 16:08:40', '2019-01-10 16:08:40'),
(36, 1, '16.00', '', 36, 4, '2019-01-10 17:19:13', '2019-01-10 17:19:13'),
(37, 1, '2.00', '', 37, 4, '2019-01-10 19:13:08', '2019-01-10 19:13:08'),
(38, 1, '4.00', '', 38, 4, '2019-01-10 19:14:02', '2019-01-10 19:14:02');

CREATE TABLE IF NOT EXISTS `ec_order_item_meta` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ec_order_item_meta_order_item_id_foreign` (`order_item_id`),
  KEY `ec_order_item_meta_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_order_item_meta` (`id`, `key`, `title`, `value`, `order_item_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'PickingUpLocation', 'Picking Up Location', 'nicosia', 1, 1, NULL, NULL),
(2, 'PickingUpDate', 'Picking Up Date', '09/12/2018', 1, 1, NULL, NULL),
(3, 'DroppingOffLocation', 'Dropping Off Loction', 'limassol', 1, 1, NULL, NULL),
(4, 'DroppingOffDate', 'Dropping Off Date', '09/13/2018', 1, 1, NULL, NULL),
(5, 'PickingUpLocation', 'Picking Up Location', 'nicosia', 2, 1, NULL, NULL),
(6, 'PickingUpDate', 'Picking Up Date', '09/12/2018', 2, 1, NULL, NULL),
(7, 'DroppingOffLocation', 'Dropping Off Loction', 'limassol', 2, 1, NULL, NULL),
(8, 'DroppingOffDate', 'Dropping Off Date', '09/13/2018', 2, 1, NULL, NULL),
(9, 'PickingUpLocation', 'Picking Up Location', 'nicosia', 3, 1, NULL, NULL),
(10, 'PickingUpDate', 'Picking Up Date', '09/12/2018', 3, 1, NULL, NULL),
(11, 'DroppingOffLocation', 'Dropping Off Loction', 'limassol', 3, 1, NULL, NULL),
(12, 'DroppingOffDate', 'Dropping Off Date', '09/13/2018', 3, 1, NULL, NULL),
(13, 'extras', 'Picking Up Location', 'a:2:{i:0;s:10:\"TV : .20 $\";i:1;s:11:\"VAT : .25 $\";}', 8, 1, NULL, NULL),
(14, 'PickingUpLocation', 'Picking Up Location', 'famagusta', 8, 1, NULL, NULL),
(15, 'PickingUpDate', 'Picking Up Date', '09/13/2018', 8, 1, NULL, NULL),
(16, 'DroppingOffLocation', 'Dropping Off Loction', 'famagusta', 8, 1, NULL, NULL),
(17, 'DroppingOffDate', 'Dropping Off Date', '09/22/2018', 8, 1, NULL, NULL),
(18, 'extras', 'Extras', 'a:0:{}', 9, 1, NULL, NULL),
(19, 'PickingUpLocation', 'Picking Up Location', 'famagusta', 9, 1, NULL, NULL),
(20, 'PickingUpDate', 'Picking Up Date', '09/23/2018', 9, 1, NULL, NULL),
(21, 'DroppingOffLocation', 'Dropping Off Loction', 'limassol', 9, 1, NULL, NULL),
(22, 'DroppingOffDate', 'Dropping Off Date', '09/26/2018', 9, 1, NULL, NULL),
(23, 'extras', 'Extras', 'a:2:{i:0;s:10:\"VAT : 25 $\";i:1;s:16:\"Baby Seat : 25 $\";}', 10, 1, NULL, NULL),
(24, 'PickingUpLocation', 'Picking Up Location', 'limassol', 10, 1, NULL, NULL),
(25, 'PickingUpDate', 'Picking Up Date', '09/27/2018', 10, 1, NULL, NULL),
(26, 'DroppingOffLocation', 'Dropping Off Loction', 'famagusta', 10, 1, NULL, NULL),
(27, 'DroppingOffDate', 'Dropping Off Date', '09/28/2018', 10, 1, NULL, NULL),
(28, 'extras', 'Extras', 'a:0:{}', 11, 9, NULL, NULL),
(29, 'PickingUpLocation', 'Picking Up Location', 'larnaca', 11, 9, NULL, NULL),
(30, 'PickingUpDate', 'Picking Up Date', '09/19/2018', 11, 9, NULL, NULL),
(31, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 11, 9, NULL, NULL),
(32, 'DroppingOffDate', 'Dropping Off Date', '09/29/2018', 11, 9, NULL, NULL),
(33, 'extras', 'Extras', 'a:0:{}', 12, 9, NULL, NULL),
(34, 'PickingUpLocation', 'Picking Up Location', 'airport', 12, 9, NULL, NULL),
(35, 'PickingUpDate', 'Picking Up Date', '09/30/2018', 12, 9, NULL, NULL),
(36, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 12, 9, NULL, NULL),
(37, 'DroppingOffDate', 'Dropping Off Date', '10/06/2018', 12, 9, NULL, NULL),
(38, 'extras', 'Extras', 'a:0:{}', 13, 8, NULL, NULL),
(39, 'PickingUpLocation', 'Picking Up Location', 'airport', 13, 8, NULL, NULL),
(40, 'PickingUpDate', 'Picking Up Date', '09/19/2018', 13, 8, NULL, NULL),
(41, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 13, 8, NULL, NULL),
(42, 'DroppingOffDate', 'Dropping Off Date', '09/29/2018', 13, 8, NULL, NULL),
(43, 'extras', 'Extras', 'a:2:{i:0;s:9:\"TV : 20 $\";i:1;s:28:\"Car Seat For Childres : 25 $\";}', 14, 1, NULL, NULL),
(44, 'PickingUpLocation', 'Picking Up Location', 'larnaca', 14, 1, NULL, NULL),
(45, 'PickingUpDate', 'Picking Up Date', '10/10/2018', 14, 1, NULL, NULL),
(46, 'DroppingOffLocation', 'Dropping Off Loction', 'kyrenia', 14, 1, NULL, NULL),
(47, 'DroppingOffDate', 'Dropping Off Date', '10/10/2018', 14, 1, NULL, NULL),
(48, 'extras', 'Extras', 'a:2:{i:0;s:9:\"TV : 20 $\";i:1;s:16:\"Baby Seat : 25 $\";}', 15, 1, NULL, NULL),
(49, 'PickingUpLocation', 'Picking Up Location', 'nicosia', 15, 1, NULL, NULL),
(50, 'PickingUpDate', 'Picking Up Date', '10/11/2018', 15, 1, NULL, NULL),
(51, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 15, 1, NULL, NULL),
(52, 'DroppingOffDate', 'Dropping Off Date', '10/12/2018', 15, 1, NULL, NULL),
(53, 'extras', 'Extras', 'a:2:{i:0;s:10:\"VAT : 25 $\";i:1;s:16:\"Baby Seat : 25 $\";}', 16, 1, NULL, NULL),
(54, 'PickingUpLocation', 'Picking Up Location', 'nicosia', 16, 1, NULL, NULL),
(55, 'PickingUpDate', 'Picking Up Date', '10/10/2018', 16, 1, NULL, NULL),
(56, 'DroppingOffLocation', 'Dropping Off Loction', 'larnaca', 16, 1, NULL, NULL),
(57, 'DroppingOffDate', 'Dropping Off Date', '10/12/2018', 16, 1, NULL, NULL),
(58, 'extras', 'Extras', 'a:2:{i:0;s:9:\"TV : 20 $\";i:1;s:28:\"Car Seat For Childres : 25 $\";}', 17, 1, NULL, NULL),
(59, 'PickingUpLocation', 'Picking Up Location', 'airport', 17, 1, NULL, NULL),
(60, 'PickingUpDate', 'Picking Up Date', '10/12/2018', 17, 1, NULL, NULL),
(61, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 17, 1, NULL, NULL),
(62, 'DroppingOffDate', 'Dropping Off Date', '10/13/2018', 17, 1, NULL, NULL),
(63, 'extras', 'Extras', 'a:2:{i:0;s:9:\"TV : 20 $\";i:1;s:28:\"Car Seat For Childres : 25 $\";}', 18, 1, NULL, NULL),
(64, 'PickingUpLocation', 'Picking Up Location', 'airport', 18, 1, NULL, NULL),
(65, 'PickingUpDate', 'Picking Up Date', '10/12/2018', 18, 1, NULL, NULL),
(66, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 18, 1, NULL, NULL),
(67, 'DroppingOffDate', 'Dropping Off Date', '10/13/2018', 18, 1, NULL, NULL),
(68, 'extras', 'Extras', 'a:2:{i:0;s:9:\"TV : 20 $\";i:1;s:28:\"Car Seat For Childres : 25 $\";}', 19, 1, NULL, NULL),
(69, 'PickingUpLocation', 'Picking Up Location', 'airport', 19, 1, NULL, NULL),
(70, 'PickingUpDate', 'Picking Up Date', '10/12/2018', 19, 1, NULL, NULL),
(71, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 19, 1, NULL, NULL),
(72, 'DroppingOffDate', 'Dropping Off Date', '10/13/2018', 19, 1, NULL, NULL),
(73, 'extras', 'Extras', 'a:2:{i:0;s:9:\"TV : 20 $\";i:1;s:28:\"Car Seat For Childres : 25 $\";}', 20, 1, NULL, NULL),
(74, 'PickingUpLocation', 'Picking Up Location', 'airport', 20, 1, NULL, NULL),
(75, 'PickingUpDate', 'Picking Up Date', '10/12/2018', 20, 1, NULL, NULL),
(76, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 20, 1, NULL, NULL),
(77, 'DroppingOffDate', 'Dropping Off Date', '10/13/2018', 20, 1, NULL, NULL),
(78, 'extras', 'Extras', 'a:2:{i:0;s:9:\"TV : 20 $\";i:1;s:28:\"Car Seat For Childres : 25 $\";}', 21, 1, NULL, NULL),
(79, 'PickingUpLocation', 'Picking Up Location', 'airport', 21, 1, NULL, NULL),
(80, 'PickingUpDate', 'Picking Up Date', '10/12/2018', 21, 1, NULL, NULL),
(81, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 21, 1, NULL, NULL),
(82, 'DroppingOffDate', 'Dropping Off Date', '10/13/2018', 21, 1, NULL, NULL),
(83, 'extras', 'Extras', 'a:0:{}', 22, 8, NULL, NULL),
(84, 'PickingUpLocation', 'Picking Up Location', 'airport', 22, 8, NULL, NULL),
(85, 'PickingUpDate', 'Picking Up Date', '12/24/2018', 22, 8, NULL, NULL),
(86, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 22, 8, NULL, NULL),
(87, 'DroppingOffDate', 'Dropping Off Date', '01/02/2019', 22, 8, NULL, NULL),
(88, 'extras', 'Extras', 'a:0:{}', 23, 4, NULL, NULL),
(89, 'PickingUpLocation', 'Picking Up Location', 'airport', 23, 4, NULL, NULL),
(90, 'PickingUpDate', 'Picking Up Date', '01/10/2019 9:00 AM', 23, 4, NULL, NULL),
(91, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 23, 4, NULL, NULL),
(92, 'DroppingOffDate', 'Dropping Off Date', '01/10/2019 9:00 AM', 23, 4, NULL, NULL),
(93, 'extras', 'Extras', 'a:0:{}', 24, 1, NULL, NULL),
(94, 'PickingUpLocation', 'Picking Up Location', 'airport', 24, 1, NULL, NULL),
(95, 'PickingUpDate', 'Picking Up Date', '01/11/2019 9:00 AM', 24, 1, NULL, NULL),
(96, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 24, 1, NULL, NULL),
(97, 'DroppingOffDate', 'Dropping Off Date', '01/12/2019 9:00 AM', 24, 1, NULL, NULL),
(98, 'extras', 'Extras', 'a:0:{}', 25, 1, NULL, NULL),
(99, 'PickingUpLocation', 'Picking Up Location', 'paphos', 25, 1, NULL, NULL),
(100, 'PickingUpDate', 'Picking Up Date', '01/12/2019 9:00 AM', 25, 1, NULL, NULL),
(101, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 25, 1, NULL, NULL),
(102, 'DroppingOffDate', 'Dropping Off Date', '01/12/2019 9:00 AM', 25, 1, NULL, NULL),
(103, 'extras', 'Extras', 'a:0:{}', 26, 1, NULL, NULL),
(104, 'PickingUpLocation', 'Picking Up Location', 'airport', 26, 1, NULL, NULL),
(105, 'PickingUpDate', 'Picking Up Date', '01/10/2019 9:00 AM', 26, 1, NULL, NULL),
(106, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 26, 1, NULL, NULL),
(107, 'DroppingOffDate', 'Dropping Off Date', '01/10/2019 9:00 AM', 26, 1, NULL, NULL),
(108, 'extras', 'Extras', 'a:0:{}', 27, 1, NULL, NULL),
(109, 'PickingUpLocation', 'Picking Up Location', 'airport', 27, 1, NULL, NULL),
(110, 'PickingUpDate', 'Picking Up Date', '01/10/2019 9:00 AM', 27, 1, NULL, NULL),
(111, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 27, 1, NULL, NULL),
(112, 'DroppingOffDate', 'Dropping Off Date', '01/10/2019 9:00 AM', 27, 1, NULL, NULL),
(113, 'extras', 'Extras', 'a:0:{}', 28, 1, NULL, NULL),
(114, 'PickingUpLocation', 'Picking Up Location', 'airport', 28, 1, NULL, NULL),
(115, 'PickingUpDate', 'Picking Up Date', '01/10/2019 9:00 AM', 28, 1, NULL, NULL),
(116, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 28, 1, NULL, NULL),
(117, 'DroppingOffDate', 'Dropping Off Date', '01/10/2019 9:00 AM', 28, 1, NULL, NULL),
(118, 'extras', 'Extras', 'a:0:{}', 29, 1, NULL, NULL),
(119, 'PickingUpLocation', 'Picking Up Location', 'airport', 29, 1, NULL, NULL),
(120, 'PickingUpDate', 'Picking Up Date', '01/10/2019 9:00 AM', 29, 1, NULL, NULL),
(121, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 29, 1, NULL, NULL),
(122, 'DroppingOffDate', 'Dropping Off Date', '01/10/2019 9:00 AM', 29, 1, NULL, NULL),
(123, 'extras', 'Extras', 'a:0:{}', 30, 1, NULL, NULL),
(124, 'PickingUpLocation', 'Picking Up Location', 'airport', 30, 1, NULL, NULL),
(125, 'PickingUpDate', 'Picking Up Date', '01/10/2019 9:00 AM', 30, 1, NULL, NULL),
(126, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 30, 1, NULL, NULL),
(127, 'DroppingOffDate', 'Dropping Off Date', '01/10/2019 9:00 AM', 30, 1, NULL, NULL),
(128, 'extras', 'Extras', 'a:0:{}', 31, 1, NULL, NULL),
(129, 'PickingUpLocation', 'Picking Up Location', 'airport', 31, 1, NULL, NULL),
(130, 'PickingUpDate', 'Picking Up Date', '01/12/2019 9:00 AM', 31, 1, NULL, NULL),
(131, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 31, 1, NULL, NULL),
(132, 'DroppingOffDate', 'Dropping Off Date', '01/12/2019 9:00 AM', 31, 1, NULL, NULL),
(133, 'extras', 'Extras', 'a:0:{}', 32, 1, NULL, NULL),
(134, 'PickingUpLocation', 'Picking Up Location', 'airport', 32, 1, NULL, NULL),
(135, 'PickingUpDate', 'Picking Up Date', '01/12/2019 9:00 AM', 32, 1, NULL, NULL),
(136, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 32, 1, NULL, NULL),
(137, 'DroppingOffDate', 'Dropping Off Date', '01/12/2019 9:00 AM', 32, 1, NULL, NULL),
(138, 'extras', 'Extras', 'a:0:{}', 33, 1, NULL, NULL),
(139, 'PickingUpLocation', 'Picking Up Location', 'paphos', 33, 1, NULL, NULL),
(140, 'PickingUpDate', 'Picking Up Date', '01/12/2019 9:00 AM', 33, 1, NULL, NULL),
(141, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 33, 1, NULL, NULL),
(142, 'DroppingOffDate', 'Dropping Off Date', '01/12/2019 9:00 AM', 33, 1, NULL, NULL),
(143, 'extras', 'Extras', 'a:0:{}', 34, 1, NULL, NULL),
(144, 'PickingUpLocation', 'Picking Up Location', 'paphos', 34, 1, NULL, NULL),
(145, 'PickingUpDate', 'Picking Up Date', '01/12/2019 9:00 AM', 34, 1, NULL, NULL),
(146, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 34, 1, NULL, NULL),
(147, 'DroppingOffDate', 'Dropping Off Date', '01/12/2019 9:00 AM', 34, 1, NULL, NULL),
(148, 'extras', 'Extras', 'a:0:{}', 35, 1, NULL, NULL),
(149, 'PickingUpLocation', 'Picking Up Location', 'airport', 35, 1, NULL, NULL),
(150, 'PickingUpDate', 'Picking Up Date', '01/14/2019 9:00 AM', 35, 1, NULL, NULL),
(151, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 35, 1, NULL, NULL),
(152, 'DroppingOffDate', 'Dropping Off Date', '01/14/2019 9:00 AM', 35, 1, NULL, NULL),
(153, 'extras', 'Extras', 'a:0:{}', 36, 4, NULL, NULL),
(154, 'PickingUpLocation', 'Picking Up Location', 'airport', 36, 4, NULL, NULL),
(155, 'PickingUpDate', 'Picking Up Date', '01/10/2019 9:00 AM', 36, 4, NULL, NULL),
(156, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 36, 4, NULL, NULL),
(157, 'DroppingOffDate', 'Dropping Off Date', '01/26/2019 9:00 AM', 36, 4, NULL, NULL),
(158, 'extras', 'Extras', 'a:0:{}', 37, 4, NULL, NULL),
(159, 'PickingUpLocation', 'Picking Up Location', 'airport', 37, 4, NULL, NULL),
(160, 'PickingUpDate', 'Picking Up Date', '01/26/2019 9:00 AM', 37, 4, NULL, NULL),
(161, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 37, 4, NULL, NULL),
(162, 'DroppingOffDate', 'Dropping Off Date', '01/28/2019 9:00 AM', 37, 4, NULL, NULL),
(163, 'extras', 'Extras', 'a:0:{}', 38, 4, NULL, NULL),
(164, 'PickingUpLocation', 'Picking Up Location', 'airport', 38, 4, NULL, NULL),
(165, 'PickingUpDate', 'Picking Up Date', '01/28/2019 9:00 AM', 38, 4, NULL, NULL),
(166, 'DroppingOffLocation', 'Dropping Off Loction', 'airport', 38, 4, NULL, NULL),
(167, 'DroppingOffDate', 'Dropping Off Date', '02/01/2019 9:00 AM', 38, 4, NULL, NULL);

CREATE TABLE IF NOT EXISTS `ec_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `published_at` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ec_products_alias_unique` (`alias`),
  KEY `ec_products_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_products` (`id`, `alias`, `status`, `img`, `price`, `user_id`, `published_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'toyota-corolla-1-6-elegant', 'draft', '18', '2', 1, '2018-08-14', NULL, '2018-08-14 09:06:12', '2019-01-10 12:30:56'),
(2, 'test', 'published', '', '0', 1, '2018-08-23', '2018-09-10 13:44:29', '2018-08-23 08:45:18', '2018-09-10 13:44:29'),
(3, 'hj', 'published', '', '30', 1, '2018-08-23', '2018-09-10 13:44:16', '2018-08-23 08:45:35', '2018-09-10 13:44:16'),
(4, 'vw-polo-1-6-tdi-comfortline-new', 'published', '62', '1', 1, '2018-09-10', NULL, '2018-09-10 13:46:16', '2019-01-10 17:18:18'),
(5, 'fghfdghfgh', 'published', '', '0', 1, '2018-09-10', '2018-09-10 13:55:52', '2018-09-10 13:55:39', '2018-09-10 13:55:52'),
(6, 'ghgh', 'published', '', '0', 1, '2018-09-10', '2018-09-10 14:00:08', '2018-09-10 13:56:07', '2018-09-10 14:00:08'),
(7, 'honda-civic-elegance', 'published', '22', '93', 1, '2018-09-10', NULL, '2018-09-10 14:06:00', '2018-09-25 09:59:33'),
(8, 'renoult-megane', 'published', '23', '10', 1, '2018-09-10', NULL, '2018-09-10 14:59:02', '2018-09-19 15:04:20'),
(9, 'volkswagen-polo', 'published', '26', '20.50', 1, '2018-09-10', NULL, '2018-09-10 15:03:51', '2018-09-27 07:01:44'),
(10, 'volkswagen-polo-1', 'published', '26', '20.50', 1, '2019-01-07', '2019-01-07 19:12:16', '2019-01-07 18:41:49', '2019-01-07 19:12:16'),
(11, 'volkswagen-polo-1-1', 'published', '26', '20.50', 1, '2019-01-07', '2019-01-07 19:12:15', '2019-01-07 18:41:55', '2019-01-07 19:12:15'),
(12, '1', 'published', '26', '20.50', 1, '2019-01-07', '2019-01-07 19:12:14', '2019-01-07 18:58:21', '2019-01-07 19:12:14'),
(13, '2', 'published', '26', '20.50', 1, '2019-01-07', '2019-01-07 19:12:14', '2019-01-07 18:58:22', '2019-01-07 19:12:14'),
(14, '3', 'published', '26', '20.50', 1, '2019-01-07', '2019-01-07 19:12:13', '2019-01-07 18:58:23', '2019-01-07 19:12:13'),
(15, '4', 'published', '26', '20.50', 1, '2019-01-07', '2019-01-07 19:12:11', '2019-01-07 18:58:31', '2019-01-07 19:12:11'),
(16, '5', 'published', '26', '20.50', 1, '2019-01-07', '2019-01-07 19:12:09', '2019-01-07 18:58:42', '2019-01-07 19:12:09'),
(19, 'renoult-megane-new', 'published', '42', '59', 1, '2019-01-07', NULL, '2019-01-07 19:17:06', '2019-01-07 19:22:28'),
(20, 'honda-civic-elegance-new', 'published', '65', '80', 1, '2019-01-07', NULL, '2019-01-07 19:17:08', '2019-01-08 13:30:52'),
(21, 'vw-polo-1-6-tdi-comfortline-new-1-2', 'published', '45', '59', 1, '2019-01-07', NULL, '2019-01-07 19:17:17', '2019-01-08 11:10:56'),
(22, 'vw-polo-1-6-tdi-comfortline-new-1-2-1', 'published', '64', '59', 1, '2019-01-07', NULL, '2019-01-07 19:17:18', '2019-01-08 13:28:22'),
(23, 'vw-polo-trendline-2-0-tdi-4', 'published', '43', '38', 1, '2019-01-07', NULL, '2019-01-07 19:25:40', '2019-01-07 19:31:06'),
(24, 'toyota-corolla-1-6-elegant-5', 'published', '52', '59', 1, '2019-01-07', NULL, '2019-01-07 19:25:41', '2019-01-08 11:28:10'),
(25, 'toyota-corolla-1-6-elegant-6', 'published', '42', '59', 1, '2019-01-08', '2019-01-08 10:35:40', '2019-01-08 10:35:02', '2019-01-08 10:35:40'),
(26, 'toyota-corolla-1-6-elegant-6-1', 'draft', '45', '59', 1, '2019-01-08', '2019-01-08 11:23:53', '2019-01-08 10:35:11', '2019-01-08 11:23:53'),
(30, 'vw-polo-1-6-tdi-comfortline-3', 'published', '66', '80', 1, '2019-01-09', NULL, '2019-01-09 09:08:49', '2019-01-09 10:14:52'),
(31, 'vw-polo-1-6-tdi-comfortline-4', 'published', '67', '80', 1, '2019-01-09', NULL, '2019-01-09 12:34:27', '2019-01-09 12:36:41');

CREATE TABLE IF NOT EXISTS `ec_product_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ec_product_translations_product_id_locale_unique` (`product_id`,`locale`),
  KEY `ec_product_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_product_translations` (`id`, `product_id`, `title`, `text`, `desc`, `keywords`, `meta_desc`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'TOYOTA COROLLA 1.6 ELEGANT', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', 'dgdfg', 'dfhdfg', 'en', '2018-08-14 09:06:12', '2019-01-08 11:58:53'),
(2, 1, 'тойота', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.33333333333333333333</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', 'dgdfg', 'dfhdfg', 'ru', '2018-08-21 14:59:00', '2018-08-21 14:59:00'),
(3, 3, 'test', '<p>sdf</p>', 'sdf', 'fghjfghj', 'ghjghj', 'en', '2018-08-23 08:45:35', '2018-08-23 08:45:35'),
(4, 5, 'fghfdghfgh', '<p>fgh</p>', 'fghfgh', '', 'fhgfghfghfgh', 'en', '2018-09-10 13:55:39', '2018-09-10 13:55:39'),
(5, 6, 'ghgh', '<p>fghfgh</p>', 'fghfgh', '', 'fdghfgh', 'en', '2018-09-10 13:56:07', '2018-09-10 13:56:07'),
(6, 4, 'VW Polo 1.6 TDI Comfortline', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2018-09-10 13:59:44', '2018-09-10 13:59:44'),
(7, 7, 'Honda Civic Elegance', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in', '', 'Honda Civic Elegance', 'en', '2018-09-10 14:06:00', '2018-09-10 14:06:00'),
(8, 8, 'Renoult Megane', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in', '', 'Renoult Megane', 'en', '2018-09-10 14:59:02', '2018-09-10 14:59:02'),
(9, 9, 'Volkswagen Polo', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2018-09-10 15:03:51', '2018-09-11 13:00:00'),
(10, 9, 'Volkswagen Polo', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'ru', '2018-09-21 09:11:48', '2018-09-21 09:11:48'),
(11, 10, 'Volkswagen Polo 1', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2019-01-07 18:41:49', '2019-01-07 18:41:49'),
(12, 11, 'Volkswagen Polo 2', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2019-01-07 18:41:55', '2019-01-07 18:41:55'),
(13, 12, 'Volkswagen Polo 2 1', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2019-01-07 18:58:21', '2019-01-07 18:58:21'),
(14, 13, 'Volkswagen Polo 2 1', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2019-01-07 18:58:22', '2019-01-07 18:58:22'),
(15, 14, 'Volkswagen Polo 2 1', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2019-01-07 18:58:23', '2019-01-07 18:58:23'),
(16, 15, 'Volkswagen Polo 2 1 1', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2019-01-07 18:58:31', '2019-01-07 18:58:31'),
(17, 16, 'Volkswagen Polo 2 1 1', '<p>This is Photoshop&rsquo;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>', 'This is Photoshop’s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.', 'Volkswagen, Polo', 'Volkswagen Polo', 'en', '2019-01-07 18:58:42', '2019-01-07 18:58:42'),
(18, 19, 'Renoult Megane', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-07 19:17:06', '2019-01-07 19:21:06'),
(19, 20, 'Honda Civic Elegance', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-07 19:17:08', '2019-01-07 19:24:06'),
(20, 21, 'VW Polo 1.6 TDI Comfortline', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-07 19:17:17', '2019-01-08 11:24:38'),
(21, 22, 'VW Polo 1.6 TDI Comfortline 2 2', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(22, 23, 'VW Polo Trendline 2.0 TDI', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-07 19:25:40', '2019-01-07 19:31:06'),
(23, 24, 'Toyota Corolla 1.6 Elegant', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-07 19:25:41', '2019-01-07 19:27:23'),
(24, 25, 'Toyota Corolla 1.6 Elegant 1', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-08 10:35:02', '2019-01-08 10:35:02'),
(25, 26, 'VW Polo 1.6 TDI Comfortline', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-08 10:35:11', '2019-01-08 10:55:14'),
(26, 30, 'VW Polo 1.6 TDI Comfortline', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-09 09:08:50', '2019-01-09 09:09:28'),
(27, 31, 'Renoult Megane', '<p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>', 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.', '', 'VW Polo 1.6 TDI Comfortline', 'en', '2019-01-09 12:34:27', '2019-01-09 12:36:41');

CREATE TABLE IF NOT EXISTS `ec_season` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `base_price` decimal(8,2) NOT NULL,
  `startDate` bigint(20) NOT NULL,
  `endDate` bigint(20) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Duration` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ec_season_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_season` (`id`, `base_price`, `startDate`, `endDate`, `cost`, `type`, `Duration`, `product_id`, `created_at`, `updated_at`) VALUES
(166, '20.00', 0, 0, '20.00', 'days', 1, 9, '2018-10-10 04:32:37', '2018-10-10 04:32:37'),
(167, '20.00', 0, 0, '19.00', 'days', 2, 9, '2018-10-10 04:32:37', '2018-10-10 04:32:37'),
(168, '20.00', 0, 0, '18.00', 'days', 3, 9, '2018-10-10 04:32:37', '2018-10-10 04:32:37'),
(169, '20.00', 0, 0, '17.00', 'days', 4, 9, '2018-10-10 04:32:37', '2018-10-10 04:32:37'),
(270, '45.00', 0, 0, '45.00', 'days', 1, 1, '2019-01-10 12:30:56', '2019-01-10 12:30:56'),
(271, '45.00', 0, 0, '40.00', 'days', 2, 1, '2019-01-10 12:30:56', '2019-01-10 12:30:56'),
(272, '45.00', 0, 0, '30.00', 'days', 5, 1, '2019-01-10 12:30:56', '2019-01-10 12:30:56'),
(273, '45.00', 0, 0, '20.00', 'days', 6, 1, '2019-01-10 12:30:56', '2019-01-10 12:30:56'),
(274, '45.00', 0, 0, '60.00', 'days', 1, 1, '2019-01-10 12:30:56', '2019-01-10 12:30:56'),
(275, '45.00', 0, 0, '55.00', 'days', 2, 1, '2019-01-10 12:30:57', '2019-01-10 12:30:57'),
(276, '45.00', 0, 0, '50.00', 'days', 3, 1, '2019-01-10 12:30:57', '2019-01-10 12:30:57'),
(277, '45.00', 0, 0, '900.00', 'days', 1, 1, '2019-01-10 12:30:57', '2019-01-10 12:30:57'),
(278, '45.00', 0, 0, '800.00', 'days', 2, 1, '2019-01-10 12:30:57', '2019-01-10 12:30:57'),
(281, '45.00', 0, 0, '5.00', 'days', 1, 4, '2019-01-10 17:18:18', '2019-01-10 17:18:18');

CREATE TABLE IF NOT EXISTS `ec_terms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ec_terms_alias_unique` (`alias`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_terms` (`id`, `parent_id`, `alias`, `type`, `img`, `created_at`, `updated_at`) VALUES
(4, 0, 'best-offers', 'category', 0, '2018-09-28 05:47:45', '2018-09-28 05:47:45'),
(5, 0, 'economic-cars', 'category', 0, '2018-09-28 05:47:55', '2018-09-28 05:47:55'),
(6, 0, 'luxury-cars', 'group', 0, '2018-09-28 05:48:44', '2018-09-28 05:48:44'),
(7, 0, 'premium-cars', 'group', 0, '2018-09-28 05:49:37', '2018-09-28 05:49:37'),
(10, 0, 'cars-economic', 'group', 0, '2018-10-10 01:51:58', '2018-10-10 01:51:58'),
(11, 0, 'business-cars', 'group', 0, '2018-10-10 01:52:13', '2018-10-10 01:52:13'),
(12, 0, 'popular-cars', 'category', 0, '2019-01-07 17:26:29', '2019-01-07 17:26:29');

CREATE TABLE IF NOT EXISTS `ec_terms_product` (
  `term_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  KEY `ec_terms_product_term_id_foreign` (`term_id`),
  KEY `ec_terms_product_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_terms_product` (`term_id`, `product_id`) VALUES
(5, 1),
(7, 1),
(4, 4),
(7, 4),
(4, 7),
(4, 8),
(7, 8),
(6, 8),
(9, 9),
(5, 4),
(9, 10),
(9, 11),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(4, 19),
(7, 19),
(5, 19),
(4, 21),
(5, 21),
(4, 22),
(7, 22),
(5, 22),
(6, 21),
(10, 21),
(6, 20),
(4, 20),
(5, 20),
(11, 20),
(5, 24),
(12, 23),
(12, 24),
(10, 24),
(5, 23),
(10, 23),
(11, 23),
(12, 26),
(6, 26),
(6, 24),
(5, 30),
(11, 30),
(12, 30),
(10, 30),
(11, 31),
(12, 31);

CREATE TABLE IF NOT EXISTS `ec_term_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ec_term_translations_term_id_locale_unique` (`term_id`,`locale`),
  KEY `ec_term_translations_locale_index` (`locale`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `ec_term_translations` (`id`, `term_id`, `title`, `keywords`, `description`, `locale`, `created_at`, `updated_at`) VALUES
(4, 4, 'Best Offers', '', '', 'en', '2018-09-28 05:47:45', '2018-09-28 05:47:45'),
(5, 5, 'Economic Cars', '', '', 'en', '2018-09-28 05:47:55', '2018-09-28 05:47:55'),
(6, 6, 'Luxury Cars', '', '', 'en', '2018-09-28 05:48:44', '2018-09-28 05:48:44'),
(7, 7, 'Premium Cars', '', '', 'en', '2018-09-28 05:49:37', '2018-09-28 05:49:37'),
(9, 9, 'Popular Cars', '', '', 'en', '2018-10-05 10:24:48', '2018-10-05 10:24:48'),
(10, 10, 'Economic cars', '', '', 'en', '2018-10-10 01:51:58', '2018-10-10 01:51:58'),
(11, 11, 'Business cars', '', '', 'en', '2018-10-10 01:52:13', '2018-10-10 01:52:13'),
(12, 12, 'Popular Cars', '', '', 'en', '2019-01-07 17:26:29', '2019-01-07 17:26:29');

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aggregate_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `image_sizes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `medias` (`id`, `path`, `directory`, `filename`, `mime_type`, `aggregate_type`, `size`, `image_sizes`, `created_at`, `updated_at`) VALUES
(7, '/uploads/2018/07/23/blog-post-870x370x2 (1).jpg', '/uploads/2018/07/23/', 'blog-post-870x370x2-(1).jpg', 'jpg', 'image', 89684, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"blog-post-870x370x2-(1)-270x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"blog-post-870x370x2-(1)-600x400.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"blog-post-870x370x2-(1)-600x426.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"blog-post-870x370x2-(1)-370x220.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"blog-post-870x370x2-(1)-70x70.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"blog-post-870x370x2-(1)-260x260.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"blog-post-870x370x2-(1)-570x270.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"blog-post-870x370x2-(1)-870x370.jpg\"}}', '2018-07-23 12:18:49', '2019-01-09 15:49:51'),
(8, '/uploads/2018/07/23/blog-post-870x370x3.jpg', '/uploads/2018/07/23/', 'blog-post-870x370x3.jpg', 'jpg', 'image', 84559, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"blog-post-870x370x3-270x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"blog-post-870x370x3-600x400.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"blog-post-870x370x3-600x426.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"blog-post-870x370x3-370x220.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"blog-post-870x370x3-70x70.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"blog-post-870x370x3-570x270.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"blog-post-870x370x3-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"blog-post-870x370x3-260x260.jpg\"}}', '2018-07-23 12:25:30', '2019-01-09 15:49:52'),
(11, '/uploads/2018/07/25/blog-post-870x370x1 (1).jpg', '/uploads/2018/07/25/', 'blog-post-870x370x1-(1).jpg', 'jpg', 'image', 83803, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"blog-post-870x370x1-(1)-270x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"blog-post-870x370x1-(1)-600x400.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"blog-post-870x370x1-(1)-600x426.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"blog-post-870x370x1-(1)-370x220.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"blog-post-870x370x1-(1)-70x70.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"blog-post-870x370x1-(1)-570x270.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"blog-post-870x370x1-(1)-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"blog-post-870x370x1-(1)-260x260.jpg\"}}', '2018-07-25 13:50:17', '2019-01-09 15:49:52'),
(17, '/uploads/2018/08/13/logo-rentit.png', '/uploads/2018/08/13/', 'logo-rentit.png', 'png', 'image', 3310, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"logo-rentit-270x220.png\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"logo-rentit-600x400.png\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"logo-rentit-600x426.png\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"logo-rentit-370x220.png\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"logo-rentit-570x270.png\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"logo-rentit-70x70.png\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"logo-rentit-870x370.png\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"logo-rentit-260x260.png\"}}', '2018-08-13 10:13:52', '2019-01-09 15:49:52'),
(18, '/uploads/2018/08/16/01-2019-lamborghini-urus-oem.jpg', '/uploads/2018/08/16/', '01-2019-lamborghini-urus-oem.jpg', 'jpg', 'image', 68480, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"01-2019-lamborghini-urus-oem-270x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"01-2019-lamborghini-urus-oem-600x400.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"01-2019-lamborghini-urus-oem-600x426.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"01-2019-lamborghini-urus-oem-370x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"01-2019-lamborghini-urus-oem-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"01-2019-lamborghini-urus-oem-260x260.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"01-2019-lamborghini-urus-oem-570x270.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"01-2019-lamborghini-urus-oem-70x70.jpg\"}}', '2018-08-16 09:09:54', '2019-01-09 15:49:52'),
(19, '/uploads/2018/09/10/Screenshot_10.png', '/uploads/2018/09/10/', 'Screenshot_10.png', 'png', 'image', 798652, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"Screenshot_10-270x220.png\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"Screenshot_10-600x400.png\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"Screenshot_10-870x370.png\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"Screenshot_10-260x260.png\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"Screenshot_10-70x70.png\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"Screenshot_10-600x426.png\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"Screenshot_10-570x270.png\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"Screenshot_10-370x220.png\"}}', '2018-09-10 13:46:02', '2019-01-09 15:49:53'),
(20, '/uploads/2018/09/10/CAC50VWC231A021001.jpg', '/uploads/2018/09/10/', 'CAC50VWC231A021001.jpg', 'jpg', 'image', 76443, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"CAC50VWC231A021001-270x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"CAC50VWC231A021001-600x400.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"CAC50VWC231A021001-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"CAC50VWC231A021001-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"CAC50VWC231A021001-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"CAC50VWC231A021001-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"CAC50VWC231A021001-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"CAC50VWC231A021001-370x220.jpg\"}}', '2018-09-10 13:58:51', '2019-01-09 15:49:52'),
(21, '/uploads/2018/09/10/491982-2016-honda-civic-touring.jpg', '/uploads/2018/09/10/', '491982-2016-honda-civic-touring.jpg', 'jpg', 'image', 42947, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"491982-2016-honda-civic-touring-270x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"491982-2016-honda-civic-touring-600x400.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"491982-2016-honda-civic-touring-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"491982-2016-honda-civic-touring-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"491982-2016-honda-civic-touring-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"491982-2016-honda-civic-touring-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"491982-2016-honda-civic-touring-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"491982-2016-honda-civic-touring-370x220.jpg\"}}', '2018-09-10 14:03:15', '2019-01-09 15:49:53'),
(22, '/uploads/2018/09/10/Screenshot_12.png', '/uploads/2018/09/10/', 'Screenshot_12.png', 'png', 'image', 369453, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"Screenshot_12-270x220.png\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"Screenshot_12-600x400.png\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"Screenshot_12-870x370.png\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"Screenshot_12-260x260.png\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"Screenshot_12-70x70.png\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"Screenshot_12-600x426.png\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"Screenshot_12-570x270.png\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"Screenshot_12-370x220.png\"}}', '2018-09-10 14:05:38', '2019-01-09 15:49:53'),
(23, '/uploads/2018/09/10/Kaptur-packshot_1536x864.jpg.ximg.l_full_m.smart.jpg', '/uploads/2018/09/10/', 'Kaptur-packshot_1536x864.jpg.ximg.l_full_m.smart.jpg', 'jpg', 'image', 83345, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-270x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-600x400.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"Kaptur-packshot_1536x864.ximg.l_full_m.smart-370x220.jpg\"}}', '2018-09-10 14:57:33', '2019-01-09 15:49:55'),
(26, '/uploads/2018/09/10/Screenshot_15.png', '/uploads/2018/09/10/', 'Screenshot_15.png', 'png', 'image', 969840, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"Screenshot_15-270x220.png\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"Screenshot_15-600x400.png\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"Screenshot_15-870x370.png\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"Screenshot_15-260x260.png\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"Screenshot_15-70x70.png\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"Screenshot_15-600x426.png\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"Screenshot_15-570x270.png\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"Screenshot_15-370x220.png\"}}', '2018-09-10 15:04:44', '2019-01-09 15:49:54'),
(29, '/uploads/2018/09/10/Screenshot_18.png', '/uploads/2018/09/10/', 'Screenshot_18.png', 'png', 'image', 704593, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"Screenshot_18-270x220.png\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"Screenshot_18-600x400.png\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"Screenshot_18-870x370.png\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"Screenshot_18-260x260.png\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"Screenshot_18-70x70.png\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"Screenshot_18-600x426.png\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"Screenshot_18-570x270.png\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"Screenshot_18-370x220.png\"}}', '2018-09-10 15:11:25', '2019-01-09 15:49:55'),
(30, '/uploads/2018/10/17/portfolio-x1-big.jpg', '/uploads/2018/10/17/', 'portfolio-x1-big.jpg', 'jpg', 'image', 155847, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x1-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x1-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x1-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x1-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x1-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x1-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x1-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x1-big-600x400.jpg\"}}', '2018-10-17 09:26:38', '2019-01-09 15:49:54'),
(31, '/uploads/2018/10/17/portfolio-x2-big.jpg', '/uploads/2018/10/17/', 'portfolio-x2-big.jpg', 'jpg', 'image', 150068, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x2-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x2-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x2-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x2-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x2-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x2-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x2-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x2-big-600x400.jpg\"}}', '2018-10-17 09:26:40', '2019-01-09 15:49:55'),
(32, '/uploads/2018/10/17/portfolio-x3-big.jpg', '/uploads/2018/10/17/', 'portfolio-x3-big.jpg', 'jpg', 'image', 123112, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x3-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x3-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x3-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x3-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x3-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x3-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x3-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x3-big-600x400.jpg\"}}', '2018-10-17 09:26:42', '2019-01-09 15:49:55'),
(33, '/uploads/2018/10/17/portfolio-x4-big.jpg', '/uploads/2018/10/17/', 'portfolio-x4-big.jpg', 'jpg', 'image', 118820, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x4-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x4-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x4-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x4-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x4-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x4-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x4-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x4-big-600x400.jpg\"}}', '2018-10-17 09:26:43', '2019-01-09 15:49:55'),
(34, '/uploads/2018/10/17/portfolio-x5-big.jpg', '/uploads/2018/10/17/', 'portfolio-x5-big.jpg', 'jpg', 'image', 112996, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x5-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x5-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x5-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x5-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x5-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x5-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x5-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x5-big-600x400.jpg\"}}', '2018-10-17 09:26:45', '2019-01-09 15:49:56'),
(35, '/uploads/2018/10/17/portfolio-x6-big.jpg', '/uploads/2018/10/17/', 'portfolio-x6-big.jpg', 'jpg', 'image', 172593, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x6-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x6-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x6-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x6-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x6-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x6-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x6-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x6-big-600x400.jpg\"}}', '2018-10-17 09:26:46', '2019-01-09 15:49:56'),
(36, '/uploads/2018/10/17/portfolio-x7-big.jpg', '/uploads/2018/10/17/', 'portfolio-x7-big.jpg', 'jpg', 'image', 133738, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x7-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x7-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x7-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x7-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x7-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x7-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x7-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x7-big-600x400.jpg\"}}', '2018-10-17 09:26:47', '2019-01-09 15:49:57'),
(37, '/uploads/2018/10/17/portfolio-x8-big.jpg', '/uploads/2018/10/17/', 'portfolio-x8-big.jpg', 'jpg', 'image', 113838, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x8-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x8-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x8-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x8-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x8-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x8-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x8-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x8-big-600x400.jpg\"}}', '2018-10-17 09:26:49', '2019-01-09 15:49:56'),
(38, '/uploads/2018/10/17/portfolio-x9-big.jpg', '/uploads/2018/10/17/', 'portfolio-x9-big.jpg', 'jpg', 'image', 126734, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x9-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x9-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x9-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x9-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x9-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x9-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x9-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x9-big-600x400.jpg\"}}', '2018-10-17 09:26:51', '2019-01-09 15:49:56'),
(39, '/uploads/2018/10/17/portfolio-x10-big.jpg', '/uploads/2018/10/17/', 'portfolio-x10-big.jpg', 'jpg', 'image', 189126, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x10-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x10-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x10-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x10-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x10-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x10-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x10-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x10-big-600x400.jpg\"}}', '2018-10-17 09:26:52', '2019-01-09 15:49:56'),
(40, '/uploads/2018/10/17/portfolio-x11-big.jpg', '/uploads/2018/10/17/', 'portfolio-x11-big.jpg', 'jpg', 'image', 150098, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x11-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x11-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x11-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x11-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x11-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x11-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x11-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x11-big-600x400.jpg\"}}', '2018-10-17 09:26:54', '2019-01-09 15:49:56'),
(41, '/uploads/2018/10/17/portfolio-x12-big.jpg', '/uploads/2018/10/17/', 'portfolio-x12-big.jpg', 'jpg', 'image', 115577, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"portfolio-x12-big-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"portfolio-x12-big-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"portfolio-x12-big-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"portfolio-x12-big-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"portfolio-x12-big-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"portfolio-x12-big-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"portfolio-x12-big-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"portfolio-x12-big-600x400.jpg\"}}', '2018-10-17 09:26:55', '2019-01-09 15:49:56'),
(42, '/uploads/2019/01/07/car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw.jpg', '/uploads/2019/01/07/', 'car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw.jpg', 'jpg', 'image', 40074, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"car-370x220x9-mvem1s7jr71saof3chgcp1i40g4p4dsla963wtryxw-600x400.jpg\"}}', '2019-01-07 19:20:46', '2019-01-09 15:49:57'),
(43, '/uploads/2019/01/07/546abeb9a10ea_-_001bmwx5m-71596909-lg.jpg', '/uploads/2019/01/07/', '546abeb9a10ea_-_001bmwx5m-71596909-lg.jpg', 'jpg', 'image', 114593, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"546abeb9a10ea_-_001bmwx5m-71596909-lg-600x400.jpg\"}}', '2019-01-07 19:29:20', '2019-01-09 15:49:57'),
(44, '/uploads/2019/01/07/pexels-photo-170811.jpeg', '/uploads/2019/01/07/', 'pexels-photo-170811.jpeg', 'jpeg', 'image', 482493, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"pexels-photo-170811-270x220.jpeg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"pexels-photo-170811-870x370.jpeg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"pexels-photo-170811-260x260.jpeg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"pexels-photo-170811-70x70.jpeg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"pexels-photo-170811-600x426.jpeg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"pexels-photo-170811-570x270.jpeg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"pexels-photo-170811-370x220.jpeg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"pexels-photo-170811-600x400.jpeg\"}}', '2019-01-07 19:30:48', '2019-01-09 15:49:57'),
(45, '/uploads/2019/01/08/polo.PNG', '/uploads/2019/01/08/', 'polo.PNG', 'PNG', 'image', 1398525, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"polo-270x220.PNG\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"polo-870x370.PNG\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"polo-260x260.PNG\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"polo-70x70.PNG\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"polo-600x426.PNG\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"polo-570x270.PNG\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"polo-370x220.PNG\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"polo-600x400.PNG\"}}', '2019-01-08 10:58:33', '2019-01-09 15:49:57'),
(50, '/uploads/2019/01/08/polo(2).jpg', '/uploads/2019/01/08/', 'polo(2).jpg', 'jpg', 'image', 229895, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"polo(2)-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"polo(2)-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"polo(2)-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"polo(2)-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"polo(2)-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"polo(2)-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"polo(2)-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"polo(2)-600x400.jpg\"}}', '2019-01-08 11:07:10', '2019-01-09 15:49:58'),
(51, '/uploads/2019/01/08/10631810803_d8cb8bbfbe_k.jpg', '/uploads/2019/01/08/', '10631810803_d8cb8bbfbe_k.jpg', 'jpg', 'image', 1063127, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"10631810803_d8cb8bbfbe_k-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"10631810803_d8cb8bbfbe_k-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"10631810803_d8cb8bbfbe_k-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"10631810803_d8cb8bbfbe_k-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"10631810803_d8cb8bbfbe_k-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"10631810803_d8cb8bbfbe_k-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"10631810803_d8cb8bbfbe_k-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"10631810803_d8cb8bbfbe_k-600x400.jpg\"}}', '2019-01-08 11:12:42', '2019-01-09 15:50:00'),
(52, '/uploads/2019/01/08/14857394591_4553d645bb_b.jpg', '/uploads/2019/01/08/', '14857394591_4553d645bb_b.jpg', 'jpg', 'image', 153448, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"14857394591_4553d645bb_b-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"14857394591_4553d645bb_b-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"14857394591_4553d645bb_b-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"14857394591_4553d645bb_b-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"14857394591_4553d645bb_b-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"14857394591_4553d645bb_b-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"14857394591_4553d645bb_b-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"14857394591_4553d645bb_b-600x400.jpg\"}}', '2019-01-08 11:27:44', '2019-01-09 15:49:58'),
(53, '/uploads/2019/01/08/4098650081_b32505414e_b.jpg', '/uploads/2019/01/08/', '4098650081_b32505414e_b.jpg', 'jpg', 'image', 240508, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"4098650081_b32505414e_b-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"4098650081_b32505414e_b-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"4098650081_b32505414e_b-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"4098650081_b32505414e_b-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"4098650081_b32505414e_b-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"4098650081_b32505414e_b-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"4098650081_b32505414e_b-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"4098650081_b32505414e_b-600x400.jpg\"}}', '2019-01-08 11:30:07', '2019-01-09 15:49:59'),
(54, '/uploads/2019/01/08/01-2019-lamborghini-urus-oem.jpg', '/uploads/2019/01/08/', '01-2019-lamborghini-urus-oem.jpg', 'jpg', 'image', 58340, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"01-2019-lamborghini-urus-oem-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"01-2019-lamborghini-urus-oem-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"01-2019-lamborghini-urus-oem-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"01-2019-lamborghini-urus-oem-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"01-2019-lamborghini-urus-oem-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"01-2019-lamborghini-urus-oem-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"01-2019-lamborghini-urus-oem-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"01-2019-lamborghini-urus-oem-600x400.jpg\"}}', '2019-01-08 11:32:08', '2019-01-09 15:49:58'),
(55, '/uploads/2019/01/08/honda.PNG', '/uploads/2019/01/08/', 'honda.PNG', 'PNG', 'image', 776366, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"honda-270x220.PNG\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"honda-870x370.PNG\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"honda-260x260.PNG\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"honda-70x70.PNG\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"honda-600x426.PNG\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"honda-570x270.PNG\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"honda-370x220.PNG\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"honda-600x400.PNG\"}}', '2019-01-08 11:41:51', '2019-01-09 15:49:58'),
(56, '/uploads/2019/01/08/111111111.PNG', '/uploads/2019/01/08/', '111111111.PNG', 'PNG', 'image', 1967490, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"111111111-270x220.PNG\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"111111111-870x370.PNG\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"111111111-260x260.PNG\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"111111111-70x70.PNG\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"111111111-600x426.PNG\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"111111111-570x270.PNG\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"111111111-370x220.PNG\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"111111111-600x400.PNG\"}}', '2019-01-08 11:58:32', '2019-01-09 15:49:58'),
(60, '/uploads/2019/01/08/JettaMkIII_Interior.JPG', '/uploads/2019/01/08/', 'JettaMkIII_Interior.JPG', 'JPG', 'image', 2285106, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"JettaMkIII_Interior-270x220.JPG\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"JettaMkIII_Interior-870x370.JPG\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"JettaMkIII_Interior-260x260.JPG\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"JettaMkIII_Interior-70x70.JPG\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"JettaMkIII_Interior-600x426.JPG\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"JettaMkIII_Interior-570x270.JPG\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"JettaMkIII_Interior-370x220.JPG\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"JettaMkIII_Interior-600x400.JPG\"}}', '2019-01-08 13:16:57', '2019-01-09 15:50:00'),
(62, '/uploads/2019/01/08/2014_Volkswagen.jpg', '/uploads/2019/01/08/', '2014_Volkswagen.jpg', 'jpg', 'image', 6103201, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"2014_Volkswagen-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"2014_Volkswagen-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"2014_Volkswagen-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"2014_Volkswagen-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"2014_Volkswagen-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"2014_Volkswagen-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"2014_Volkswagen-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"2014_Volkswagen-600x400.jpg\"}}', '2019-01-08 13:21:26', '2019-01-09 15:49:59'),
(63, '/uploads/2019/01/08/2017_Renault_Megan.jpg', '/uploads/2019/01/08/', '2017_Renault_Megan.jpg', 'jpg', 'image', 4182910, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"2017_Renault_Megan-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"2017_Renault_Megan-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"2017_Renault_Megan-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"2017_Renault_Megan-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"2017_Renault_Megan-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"2017_Renault_Megan-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"2017_Renault_Megan-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"2017_Renault_Megan-600x400.jpg\"}}', '2019-01-08 13:25:43', '2019-01-09 15:50:02'),
(64, '/uploads/2019/01/08/Nightblue.JPG', '/uploads/2019/01/08/', 'Nightblue.JPG', 'JPG', 'image', 1374884, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"Nightblue-270x220.JPG\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"Nightblue-870x370.JPG\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"Nightblue-260x260.JPG\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"Nightblue-70x70.JPG\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"Nightblue-600x426.JPG\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"Nightblue-570x270.JPG\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"Nightblue-370x220.JPG\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"Nightblue-600x400.JPG\"}}', '2019-01-08 13:28:05', '2019-01-09 15:50:01'),
(65, '/uploads/2019/01/08/Düsseldorf.jpg', '/uploads/2019/01/08/', 'Düsseldorf.jpg', 'jpg', 'image', 4457091, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"D\\u00fcsseldorf-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"D\\u00fcsseldorf-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"D\\u00fcsseldorf-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"D\\u00fcsseldorf-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"D\\u00fcsseldorf-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"D\\u00fcsseldorf-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"D\\u00fcsseldorf-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"D\\u00fcsseldorf-600x400.jpg\"}}', '2019-01-08 13:30:39', '2019-01-09 15:50:03'),
(66, '/uploads/2019/01/09/volkswagen-auto-historically-vw-163809.jpeg', '/uploads/2019/01/09/', 'volkswagen-auto-historically-vw-163809.jpeg', 'jpeg', 'image', 199563, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"volkswagen-auto-historically-vw-163809-270x220.jpeg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"volkswagen-auto-historically-vw-163809-870x370.jpeg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"volkswagen-auto-historically-vw-163809-260x260.jpeg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"volkswagen-auto-historically-vw-163809-70x70.jpeg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"volkswagen-auto-historically-vw-163809-600x426.jpeg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"volkswagen-auto-historically-vw-163809-570x270.jpeg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"volkswagen-auto-historically-vw-163809-370x220.jpeg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"volkswagen-auto-historically-vw-163809-600x400.jpeg\"}}', '2019-01-09 10:14:43', '2019-01-09 15:50:02'),
(67, '/uploads/2019/01/09/rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac.jpg', '/uploads/2019/01/09/', 'rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac.jpg', 'jpg', 'image', 43595, '{\"thumbnail-270x220\":{\"width\":270,\"height\":220,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-270x220.jpg\"},\"thumbnail-870x370\":{\"width\":870,\"height\":370,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-870x370.jpg\"},\"thumbnail-260x260\":{\"width\":260,\"height\":260,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-260x260.jpg\"},\"thumbnail-70x70\":{\"width\":70,\"height\":70,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-70x70.jpg\"},\"thumbnail-600x426\":{\"width\":600,\"height\":426,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-600x426.jpg\"},\"thumbnail-570x270\":{\"width\":570,\"height\":270,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-570x270.jpg\"},\"thumbnail-370x220\":{\"width\":370,\"height\":220,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-370x220.jpg\"},\"thumbnail-600x400\":{\"width\":600,\"height\":400,\"file\":\"rentit-car-from-unsplash-mvem1qbvdiz7nghtngn3k1z6todyozl4lzv4y9urac-600x400.jpg\"}}', '2019-01-09 12:35:07', '2019-01-09 15:50:01');

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `menus` (`id`, `location`, `created_at`, `updated_at`) VALUES
(1, 0, '2018-07-17 12:13:58', '2018-07-17 12:13:58'),
(2, 0, '2018-08-07 07:10:54', '2018-08-07 07:10:54');

CREATE TABLE IF NOT EXISTS `menu_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `output` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_translations_menu_id_locale_unique` (`menu_id`,`locale`),
  KEY `menu_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `menu_translations` (`id`, `menu_id`, `title`, `output`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'Меню шапки', '[{\"text\":\"Home\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"children\":[{\"text\":\"Home 1\",\"href\":\"/\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 2\",\"href\":\"/index-2\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 3\",\"href\":\"/index-3\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 4\",\"href\":\"/index-4\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 5\",\"href\":\"/index-5\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 6\",\"href\":\"/index-6\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Hot Deals\",\"href\":\"https://lararent.alfafox.site/products\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Vehicles\",\"href\":\"/products\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"FAQS\",\"href\":\"{SITE_URL}/faqs\",\"target\":\"_self\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \",\"title\":\"\"},{\"text\":\"Features\",\"href\":\"#\",\"icon\":\"empty\",\"target\":\"_blank\",\"title\":\"\",\"megamenu\":\"yes\",\"children\":[{\"text\":\"Paragraph\",\"href\":\"#Paragraph\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":null,\"Description\":\"          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>\\n                                                <p>Suspendisse molestie est nec tortor placerat, vel pellentesque metus sollicitudin. Suspendisse congue sem mauris, at ultrices felis blandit non.</p>\\n                                        \"},{\"text\":\"Portfolio\",\"href\":\"#Portfolio\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"on\",\"children\":[{\"text\":\"Portfolio 3 Columns\",\"href\":\"{SITE_URL}/portfolio\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"Portfolio 4 Columns\",\"href\":\"{SITE_URL}/portfolio?style=4\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"Portfolio Alternate\",\"href\":\"{SITE_URL}/portfolio?style=alt\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"Portfolio Single\",\"href\":\"{SITE_URL}/portfolio/project-title-5\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"}]},{\"text\":\"Pages\",\"href\":\"#Pages\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"on\",\"children\":[{\"text\":\"Blog\",\"href\":\"/posts\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"404 Page\",\"href\":\"{SITE_URL}/404\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"Coming soon\",\"href\":\"{SITE_URL}/coming-soon\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"}]},{\"text\":\"Pages\",\"href\":\"#Pages\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"on\",\"children\":[{\"text\":\"Car Listing\",\"href\":\"{SITE_URL}/products\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"Booking & Payment\",\"href\":\"{SITE_URL}/products/volkswagen-polo\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"About\",\"href\":\"{SITE_URL}/about-us\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"Login\",\"href\":\"{SITE_URL}/login-auth\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"}]}]},{\"text\":\"Blog\",\"href\":\"/posts\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"children\":[{\"text\":\"Blog Sidebar Left \",\"href\":\"/posts\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Blog Sidebar Right\",\"href\":\"/posts?sidebar_right=1\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Blog Single Post\",\"href\":\"https://lararent.alfafox.site/posts/sample-post-with-featured-image\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Contact\",\"href\":\"{SITE_URL}/contact-us\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"}]', 'ru', '2018-07-17 12:13:58', '2019-01-16 08:24:14'),
(2, 1, 'Header menu', '[{\"text\":\"Home\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"children\":[{\"text\":\"Home 1\",\"href\":\"/\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 2\",\"href\":\"/index-2\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 3\",\"href\":\"/index-3\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 4\",\"href\":\"/index-4\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 5\",\"href\":\"/index-5\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Home 6\",\"href\":\"/index-6\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Hot Deals\",\"href\":\"https://lararent.alfafox.site/products\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Vehicles\",\"href\":\"/products\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"FAQS\",\"href\":\"{SITE_URL}/faqs\",\"target\":\"_self\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \",\"title\":\"\"},{\"text\":\"Features\",\"href\":\"#\",\"icon\":\"empty\",\"target\":\"_blank\",\"title\":\"\",\"megamenu\":\"yes\",\"children\":[{\"text\":\"Paragraph\",\"href\":\"#Paragraph\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":null,\"Description\":\"          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>\\n                                                <p>Suspendisse molestie est nec tortor placerat, vel pellentesque metus sollicitudin. Suspendisse congue sem mauris, at ultrices felis blandit non.</p>\\n                                        \"},{\"text\":\"Portfolio\",\"href\":\"#Portfolio\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"on\",\"children\":[{\"text\":\"Portfolio 3 Columns\",\"href\":\"{SITE_URL}/portfolio\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"Portfolio 4 Columns\",\"href\":\"{SITE_URL}/portfolio?style=4\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"Portfolio Alternate\",\"href\":\"{SITE_URL}/portfolio?style=alt\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"Portfolio Single\",\"href\":\"{SITE_URL}/portfolio/project-title-5\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"}]},{\"text\":\"Pages\",\"href\":\"#Pages\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"on\",\"children\":[{\"text\":\"Blog\",\"href\":\"/posts\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\"},{\"text\":\"404 Page\",\"href\":\"{SITE_URL}/404\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"Coming soon\",\"href\":\"{SITE_URL}/coming-soon\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"}]},{\"text\":\"Pages\",\"href\":\"#Pages\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"on\",\"children\":[{\"text\":\"Car Listing\",\"href\":\"{SITE_URL}/products\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"Booking & Payment\",\"href\":\"{SITE_URL}/products/volkswagen-polo\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"About\",\"href\":\"{SITE_URL}/about-us\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"},{\"text\":\"Login\",\"href\":\"{SITE_URL}/login-auth\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"}]}]},{\"text\":\"Blog\",\"href\":\"/posts\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"children\":[{\"text\":\"Blog Sidebar Left \",\"href\":\"/posts\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Blog Sidebar Right\",\"href\":\"/posts?sidebar_right=1\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Blog Single Post\",\"href\":\"https://lararent.alfafox.site/posts/sample-post-with-featured-image\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Contact\",\"href\":\"{SITE_URL}/contact-us\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"megamenu\":\"no\",\"Description\":\"\\n                                                                            \"}]', 'en', '2018-07-17 12:15:59', '2019-01-07 10:13:41'),
(3, 2, 'INFORMATION', '[{\"text\":\"About Us\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Delivery Information\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Contact Us\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Terms and Conditions\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Private Policy\",\"href\":\"#\",\"target\":\"_self\",\"title\":\"\"}]', 'en', '2018-08-07 07:10:54', '2018-08-07 07:10:54');

CREATE TABLE IF NOT EXISTS `metas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metable_id` int(11) NOT NULL,
  `metable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `metas` (`id`, `name`, `value`, `metable_id`, `metable_type`, `created_at`, `updated_at`) VALUES
(1, 'attributes', '', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-08-24 04:21:11', '2018-08-24 04:29:13'),
(2, '_rental_resource', '', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-08-24 04:21:11', '2018-09-03 09:05:24'),
(3, 'gallery_media', '56', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-08-24 04:21:33', '2019-01-08 13:03:34'),
(4, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-08-24 04:40:16', '2018-09-27 14:23:43'),
(5, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-08-24 04:40:16', '2018-09-27 14:23:43'),
(9, 'attributes', '', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 13:59:45', '2018-09-10 13:59:45'),
(10, 'gallery_media', '21,22', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 14:06:00', '2018-09-10 14:06:00'),
(11, 'attributes', '', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 14:06:00', '2018-09-10 14:06:00'),
(12, '__picking_up_location', '[\"larnaca\",\"limassol\",\"famagusta\"]', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 14:06:00', '2018-09-10 14:06:00'),
(13, '__dropping_off_location', '[\"nicosia\",\"kyrenia\",\"famagusta\"]', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 14:06:00', '2018-09-10 14:06:00'),
(14, 'attributes', '', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 14:59:02', '2018-09-10 14:59:02'),
(15, 'attributes', '', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 15:03:51', '2018-09-10 15:03:51'),
(16, 'gallery_media', '29', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-10 15:05:12', '2018-09-10 15:12:27'),
(18, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-12 06:06:46', '2018-09-28 10:26:58'),
(19, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-12 06:06:46', '2018-09-28 10:26:58'),
(20, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-12 10:52:12', '2018-09-19 15:04:00'),
(21, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-12 10:52:12', '2018-09-19 15:04:00'),
(22, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-14 05:54:11', '2018-09-14 10:57:25'),
(23, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-14 05:54:11', '2018-09-14 10:57:25'),
(24, 'rentit_lat_long', '34.7720133,32.429736899999966', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-14 06:49:58', '2018-09-14 10:57:25'),
(25, 'rentit_formatted_address', 'Пафос, Кипр', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-14 06:49:58', '2018-09-14 10:57:25'),
(26, 'rentit_lat_long', '35.126413,33.429858999999965', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-18 09:18:29', '2018-09-18 09:18:29'),
(27, 'rentit_formatted_address', 'Кипр', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-18 09:18:29', '2018-09-18 09:18:29'),
(28, 'rentIt_visitors', '7', 5, 'Corp\\Post', '2018-09-19 06:14:01', '2018-12-14 10:55:39'),
(29, 'rentit_lat_long', '35.0352421,33.986148999999955', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-19 15:04:00', '2018-09-19 15:04:00'),
(30, 'rentit_formatted_address', 'Паралимни, Кипр', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-19 15:04:00', '2018-09-19 15:04:00'),
(31, 'gallery_media', '23,22', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-19 15:05:45', '2018-09-19 15:05:45'),
(32, 'product_icons', '', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 08:56:12', '2018-09-21 08:56:12'),
(33, 'product_icons', '', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:25:31', '2018-09-21 09:25:31'),
(34, 'product_icons', '', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:25:52', '2018-09-21 09:25:52'),
(35, 'rentit_lat_long', '35.23865486518234,33.188159781249965', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:26:20', '2019-01-09 12:38:59'),
(36, 'rentit_formatted_address', 'Hellenic Bank, Εσπερίδων 5, Strovolos, Кипр', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:26:20', '2019-01-09 12:38:59'),
(37, 'product_icons', '', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:26:20', '2018-09-21 09:26:20'),
(38, 'rentit_lat_long', '34.76385829994759,33.029500659277346', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:26:53', '2018-09-21 09:26:53'),
(39, 'rentit_formatted_address', 'Unnamed Road, Fasoula, Кипр', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:26:53', '2018-09-21 09:26:53'),
(40, 'product_icons', '', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:26:53', '2018-09-21 09:26:53'),
(41, 'product_stars', '5', 9, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-21 09:38:59', '2018-09-21 09:41:52'),
(42, 'product_stars', '5', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-24 13:07:03', '2018-09-24 13:07:03'),
(43, 'product_stars', '5', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-25 09:59:33', '2018-09-25 09:59:33'),
(44, '_rental_resource', '', 8, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-26 06:31:08', '2018-09-26 06:31:08'),
(45, '_rental_resource', '', 7, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-26 08:19:06', '2018-09-26 08:19:06'),
(46, '_rental_resource', '', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-26 08:27:12', '2018-09-26 08:27:12'),
(47, 'product_stars', '5', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-26 08:27:12', '2018-09-26 08:27:12'),
(48, 'product_stars', '5', 1, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2018-09-27 14:23:43', '2018-09-27 14:23:43'),
(49, 'rentIt_visitors', '41', 3, 'Corp\\Post', '2018-10-05 07:01:41', '2019-01-14 20:14:47'),
(50, 'rentIt_visitors', '9', 3, 'Corp\\Portfolio', '2018-10-18 07:02:17', '2018-10-18 08:49:16'),
(51, 'rentIt_visitors', '1', 2, 'Corp\\Portfolio', '2018-10-18 08:50:08', '2018-10-18 08:50:08'),
(52, 'gallery_media', '32,30,36,40', 3, 'Corp\\Portfolio', '2018-10-18 12:55:36', '2018-10-18 13:01:31'),
(53, 'gallery_media', '34,31,36', 11, 'Corp\\Portfolio', '2018-10-23 09:59:20', '2018-10-23 09:59:20'),
(54, 'gallery_media', '34,33,35', 12, 'Corp\\Portfolio', '2018-10-23 10:01:48', '2018-10-23 10:01:48'),
(55, 'gallery_media', '36,39,40', 13, 'Corp\\Portfolio', '2018-10-23 10:04:59', '2018-10-23 10:04:59'),
(56, 'gallery_media', '37,36', 7, 'Corp\\Portfolio', '2018-10-24 15:05:49', '2018-10-24 15:05:49'),
(57, 'rentIt_visitors', '1', 1, 'Corp\\Page', '2018-10-25 07:44:53', '2018-10-25 07:44:53'),
(58, 'rentit_disable_footer', 'on', 7, 'Corp\\Page', '2019-01-06 10:05:18', '2019-01-07 09:38:05'),
(115, 'attributes', '', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(116, '_rental_resource', '', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(117, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(118, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(119, 'rentit_lat_long', '34.93749806821699,33.182666617187465', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-09 12:40:20'),
(120, 'rentit_formatted_address', 'Unnamed Road, Кипр', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(121, 'product_stars', '5', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(122, 'product_icons', '', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(123, 'attributes', '', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(124, '_rental_resource', '', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(125, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(126, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(127, 'rentit_lat_long', '52.52000659999999,13.404953999999975', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-08 11:43:43'),
(128, 'rentit_formatted_address', 'Берлин, Германия', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-08 11:43:43'),
(129, 'product_stars', '5', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(130, 'product_icons', '', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(131, 'attributes', '', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(132, '_rental_resource', '', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(133, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(134, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(135, 'rentit_lat_long', '34.955508773820036,33.122241812499965', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-09 12:40:59'),
(136, 'rentit_formatted_address', 'E903, Кипр', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-09 12:40:59'),
(137, 'product_stars', '5', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(138, 'product_icons', '', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(139, 'attributes', '', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(140, '_rental_resource', '', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(141, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(142, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(143, 'rentit_lat_long', '35.09945189506355,32.600391226562465', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-09 12:41:37'),
(144, 'rentit_formatted_address', 'Unnamed Road, Кипр', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(145, 'product_stars', '5', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(146, 'product_icons', '', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(147, 'gallery_media', '40,64', 22, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:17:57', '2019-01-08 13:28:22'),
(148, 'gallery_media', '42,63', 19, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:21:06', '2019-01-08 13:25:55'),
(149, 'attributes', '', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(150, '_rental_resource', '', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(151, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(152, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(153, 'rentit_lat_long', '34.955508773820036,32.655322867187465', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-09 12:42:20'),
(154, 'rentit_formatted_address', 'Unnamed Road, Кипр', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(155, 'product_stars', '5', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(156, 'product_icons', '', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(157, 'attributes', '', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(158, '_rental_resource', '', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(159, '__picking_up_location', '[\"airport\",\"limassol\",\"kyrenia\",\"famagusta\"]', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-09 10:28:29'),
(160, '__dropping_off_location', '[\"airport\",\"nicosia\",\"larnaca\",\"famagusta\"]', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-09 10:28:29'),
(161, 'rentit_lat_long', '34.895722607702524,33.09210523222657', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(162, 'rentit_formatted_address', 'Unnamed Road, Кипр', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(163, 'product_stars', '5', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(164, 'product_icons', '', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(165, 'gallery_media', '18,53', 24, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:28:20', '2019-01-08 11:33:17'),
(166, 'gallery_media', '43,44', 23, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-07 19:30:52', '2019-01-07 19:30:52'),
(185, 'gallery_media', '51,50', 21, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-08 11:10:56', '2019-01-08 11:13:32'),
(186, 'gallery_media', '55', 20, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-08 11:44:13', '2019-01-08 11:44:13'),
(187, 'gallery_media', '60', 4, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-08 13:17:12', '2019-01-08 13:23:32'),
(188, 'gallery_media', '55', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(189, 'attributes', '', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(190, '_rental_resource', '', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(191, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(192, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(193, 'rentit_lat_long', '35.01401623516481,34.061572867187465', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 12:39:41'),
(194, 'rentit_formatted_address', 'Fig Tree Bay, Protaras, Кипр', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 12:39:41'),
(195, 'product_stars', '5', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(196, 'product_icons', '', 30, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(197, 'gallery_media', '55,52,64', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:36:41'),
(198, 'attributes', '', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(199, '_rental_resource', '', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(200, '__picking_up_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(201, '__dropping_off_location', '[\"airport\",\"paphos\",\"nicosia\",\"larnaca\",\"limassol\",\"kyrenia\",\"famagusta\"]', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(202, 'rentit_lat_long', '35.27902397540414,33.940723257812465', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:38:01'),
(203, 'rentit_formatted_address', 'Stadiou, Deryneia, Кипр', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:38:01'),
(204, 'product_stars', '5', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(205, 'product_icons', '', 31, 'Corp\\Plugins\\eCommerce\\Models\\Product', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(206, 'rentit_disable_footer', '0', 1, 'Corp\\Page', '2019-01-11 12:18:23', '2019-01-11 12:18:40'),
(207, 'rentIt_visitors', '2', 13, 'Corp\\Post', '2019-01-15 12:50:23', '2019-01-15 12:50:33'),
(208, 'rentIt_visitors', '6', 16, 'Corp\\Post', '2019-01-16 07:56:23', '2019-01-16 07:59:32');

CREATE TABLE IF NOT EXISTS `meta_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `meta_id` int(10) UNSIGNED NOT NULL,
  `translation_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meta_translations_meta_id_locale_unique` (`meta_id`,`locale`),
  KEY `meta_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `meta_translations` (`id`, `meta_id`, `translation_value`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"value\":[\"Under 25,000 Km\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2018-08-24 04:27:48', '2019-01-08 13:05:07'),
(2, 1, '{\"value\":[\"\\u0447\\u0430\\u0448\\u043a\\u0430\"]}', 'ru', '2018-08-24 04:35:30', '2018-08-24 04:35:30'),
(3, 2, '{\"item_name\":[\"TV\",\"VAT\",\"Baby Seat\",\"Car Seat For Childres\"],\"quantity\":[\"1\",\"1\",\"1\",\"1\"],\"cost\":[\"20\",\"25\",\"25\",\"25\"],\"duration_type\":[\"days\",\"total\",\"fixed_change\",\"days\"]}', 'en', '2018-09-03 09:05:24', '2018-09-03 10:39:42'),
(6, 9, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2018-09-10 13:59:45', '2019-01-07 19:03:49'),
(7, 11, 'null', 'en', '2018-09-10 14:06:00', '2018-09-10 14:06:00'),
(8, 14, '{\"value\":[\"Fuel Diesel \\/ 1600 cm3 Engine\",\"Under 25,000 Km\",\"Transmission Manual\",\"5 Year service included\",\"Manufacturing Year 2014\",\"5 Doors and Panorama View\"]}', 'en', '2018-09-10 14:59:02', '2018-10-10 04:31:53'),
(9, 15, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2018-09-10 15:03:51', '2018-10-10 04:32:37'),
(10, 32, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2018-09-21 08:56:12', '2018-09-24 12:25:07'),
(11, 15, '{\"value\":[null]}', 'ru', '2018-09-21 09:11:48', '2018-09-21 09:11:48'),
(12, 32, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2013\";i:1;s:12:\"Дизель\";i:2;s:14:\"Автомат\";i:3;s:5:\"25000\";}}', 'ru', '2018-09-21 09:11:49', '2018-09-21 09:30:19'),
(13, 33, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2014\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2018-09-21 09:25:31', '2018-09-24 13:07:03'),
(14, 34, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2013\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2018-09-21 09:25:52', '2018-09-21 09:25:52'),
(15, 37, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2013\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2018-09-21 09:26:20', '2018-09-21 09:26:20'),
(16, 40, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2013\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2018-09-21 09:26:53', '2018-09-21 09:26:53'),
(17, 44, '{\"quantity\":[null]}', 'en', '2018-09-26 06:31:08', '2018-09-26 06:31:08'),
(18, 45, '{\"quantity\":[null,null]}', 'en', '2018-09-26 08:19:06', '2018-09-26 08:19:06'),
(19, 46, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2018-09-26 08:27:12', '2019-01-07 19:03:49'),
(20, 2, '{\"item_name\":[\"TV\",\"VAT\",\"Baby Seat\",\"Car Seat For Childres\"],\"quantity\":[\"1\",\"1\",\"1\",\"1\"],\"cost\":[\"20\",\"25\",\"25\",\"25\"],\"duration_type\":[\"days\",\"total\",\"fixed_change\",\"days\"]}', 'ru', '2018-10-01 09:07:36', '2018-10-01 09:07:36'),
(21, 40, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2013\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'ru', '2018-10-01 09:07:36', '2018-10-01 09:07:36'),
(36, 115, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(37, 116, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-07 19:17:06', '2019-01-07 19:17:06'),
(38, 122, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-07 19:17:06', '2019-01-09 10:26:33'),
(39, 123, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(40, 124, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-07 19:17:08', '2019-01-07 19:17:08'),
(41, 130, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-07 19:17:08', '2019-01-09 10:27:14'),
(42, 131, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(43, 132, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-07 19:17:17', '2019-01-07 19:17:17'),
(44, 138, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-07 19:17:17', '2019-01-09 10:28:00'),
(45, 139, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(46, 140, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-07 19:17:18', '2019-01-07 19:17:18'),
(47, 146, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-07 19:17:18', '2019-01-09 10:26:42'),
(48, 149, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(49, 150, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-07 19:25:40', '2019-01-07 19:25:40'),
(50, 156, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-07 19:25:40', '2019-01-09 10:26:23'),
(51, 157, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(52, 158, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-07 19:25:41', '2019-01-07 19:25:41'),
(53, 164, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-07 19:25:41', '2019-01-09 10:27:43'),
(60, 189, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(61, 190, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-09 09:08:50', '2019-01-09 09:08:50'),
(62, 196, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-09 09:08:50', '2019-01-09 10:25:33'),
(63, 198, '{\"value\":[\"Under 25,000 Km\",\"Fuel Diesel \\/ 1600 cm3 Engine\",\"5 Year service included\",\"Transmission Manual\",\"Manufacturing Year 2018\",\"5 Doors and Panorama View\"]}', 'en', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(64, 199, '{\"item_name\":[\"TV\",\"Baby Seat\",\"Navigation\",\"Excess Protection\",\"Additional Driver\",\"Car Seat For Childres\",\"Ful Rent a Car Insures\",\"Wheels and Glass Insures\",\"Taking from Airport\",\"VAT\"],\"quantity\":[\"1\",\"1\",null,null,null,null,null,null,null,null],\"cost\":[\"20\",\"12\",\"12\",\"42\",\"12\",null,null,null,\"10\",null],\"duration_type\":[\"days\",\"days\",\"days\",\"total\",\"days\",\"days\",\"days\",\"days\",\"fixed_change\",\"Included\"]}', 'en', '2019-01-09 12:34:27', '2019-01-09 12:34:27'),
(65, 205, 'a:2:{s:4:\"icon\";a:4:{i:0;s:6:\"fa-car\";i:1;s:12:\"fa-dashboard\";i:2;s:6:\"fa-cog\";i:3;s:7:\"fa-road\";}s:4:\"text\";a:4:{i:0;s:4:\"2018\";i:1;s:6:\"Diesel\";i:2;s:4:\"Auto\";i:3;s:5:\"25000\";}}', 'en', '2019-01-09 12:34:27', '2019-01-09 12:36:41');

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metable_id` int(11) NOT NULL,
  `metable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `modules` (`id`, `name`, `metable_id`, `metable_type`, `sorting`, `created_at`, `updated_at`) VALUES
(24, 'breadcrumbs__0', 1, 'Corp\\Page', 0, '2018-11-29 11:13:17', '2018-11-29 16:56:58'),
(27, 'page_section_with_container__0', 1, 'Corp\\Page', 1, '2018-11-30 14:09:27', '2018-11-30 14:09:27'),
(28, 'breadcrumbs__0', 5, 'Corp\\Page', 0, '2018-12-01 08:23:45', '2018-12-01 08:23:45'),
(31, 'login_section__0', 5, 'Corp\\Page', 1, '2018-12-03 16:21:37', '2018-12-03 16:21:37'),
(32, 'breadcrumbs__0', 6, 'Corp\\Page', 0, '2018-12-20 18:53:01', '2018-12-20 18:53:01'),
(33, 'contact_us__0', 6, 'Corp\\Page', 1, '2018-12-21 09:04:22', '2018-12-21 09:04:22'),
(34, 'contact_us_map__0', 6, 'Corp\\Page', 2, '2018-12-21 09:04:22', '2018-12-21 09:04:22'),
(36, 'faq_container__0', 7, 'Corp\\Page', 1, '2019-01-06 11:42:34', '2019-01-06 11:42:34'),
(37, 'contact_us_faq__0', 7, 'Corp\\Page', 2, '2019-01-06 11:42:35', '2019-01-06 11:42:35'),
(38, 'page_section_with_container__0', 7, 'Corp\\Page', 2, '2019-01-07 09:15:23', '2019-01-07 09:15:23'),
(39, 'breadcrumbs__0', 7, 'Corp\\Page', 0, '2019-01-07 10:07:12', '2019-01-07 10:07:12');

CREATE TABLE IF NOT EXISTS `module_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module_id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `variables` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_translations_module_id_locale_unique` (`module_id`,`locale`),
  KEY `module_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `module_translations` (`id`, `module_id`, `value`, `variables`, `locale`, `created_at`, `updated_at`) VALUES
(24, 24, '', '', 'en', '2018-11-29 11:13:17', '2018-11-29 15:11:34'),
(27, 27, '<section id=\"page_section_with_container__0\" class=\"page-section color  pb-module-section ui-sortable-handle\">\n	<div class=\"container\">\n\n		<p class=\"text-center lead edit\" ><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. Morbi fermentum justo vitae convallis varius. Nulla tristique risus ut justo pulvinar mattis. Phasellus aliquet egestas mauris in venenatis. Nulla tristique risus ut justo pulvinar mattis. Phasellus aliquet egestas mauris in venenatis.</p>\n		<hr class=\"page-divider\">\n		<div class=\"row\">\n			<div class=\"col-md-3\">\n				<div class=\"thumbnail thumbnail-team no-border no-padding\">\n					<div class=\"media\">\n						<img class=\"pb-img-edit\" src=\"https://lararent.alfafox.site/rentit/assets/img/preview/team/team-270x270x1.jpg\" alt=\"\">\n					</div>\n					<div class=\"caption\">\n						<h4 class=\"caption-title edit \" >Jessica Flipo<small>Support team</small></h4>\n						<ul class=\"social-icons\">\n							<li><a href=\"#\" class=\"facebook\"><i class=\"fa fa-facebook\"></i></a></li>\n							<li><a href=\"#\" class=\"twitter\"><i class=\"fa fa-twitter\"></i></a></li>\n							<li><a href=\"#\" class=\"instagram\"><i class=\"fa fa-instagram\"></i></a></li>\n							<li><a href=\"#\" class=\"pinterest\"><i class=\"fa fa-pinterest\"></i></a></li>\n						</ul>\n						<div class=\"caption-text edit edit\" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ullamcorper, quam vel viverra laoreet, nibh libero adipiscing diam, sit amet dictum sem nisi ut sapien.</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"col-md-3\">\n				<div class=\"thumbnail thumbnail-team no-border no-padding\">\n					<div class=\"media\">\n						<img class=\"pb-img-edit\" src=\"https://lararent.alfafox.site/rentit/assets/img/preview/team/team-270x270x2.jpg\" alt=\"\">\n					</div>\n					<div class=\"caption\">\n						<h4 class=\"caption-title edit \" >Martin&nbsp;Gavaski<small>Support team</small></h4>\n						<ul class=\"social-icons\">\n							<li><a href=\"#\" class=\"facebook\"><i class=\"fa fa-facebook\"></i></a></li>\n							<li><a href=\"#\" class=\"twitter\"><i class=\"fa fa-twitter\"></i></a></li>\n							<li><a href=\"#\" class=\"instagram\"><i class=\"fa fa-instagram\"></i></a></li>\n							<li><a href=\"#\" class=\"pinterest\"><i class=\"fa fa-pinterest\"></i></a></li>\n						</ul>\n						<div class=\"caption-text edit\" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ullamcorper, quam vel viverra laoreet, nibh libero adipiscing diam, sit amet dictum sem nisi ut sapien.</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"col-md-3\">\n				<div class=\"thumbnail thumbnail-team no-border no-padding\">\n					<div class=\"media\">\n						<img class=\"pb-img-edit\" src=\"https://lararent.alfafox.site/rentit/assets/img/preview/team/team-270x270x3.jpg\" alt=\"\">\n					</div>\n					<div class=\"caption\">\n						<h4 class=\"caption-title edit\" >Samantha Andres<small>Support team</small></h4>\n						<ul class=\"social-icons\">\n							<li><a href=\"#\" class=\"facebook\"><i class=\"fa fa-facebook\"></i></a></li>\n							<li><a href=\"#\" class=\"twitter\"><i class=\"fa fa-twitter\"></i></a></li>\n							<li><a href=\"#\" class=\"instagram\"><i class=\"fa fa-instagram\"></i></a></li>\n							<li><a href=\"#\" class=\"pinterest\"><i class=\"fa fa-pinterest\"></i></a></li>\n						</ul>\n						<div class=\"caption-text edit\" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ullamcorper, quam vel viverra laoreet, nibh libero adipiscing diam, sit amet dictum sem nisi ut sapien.</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"col-md-3\">\n				<div class=\"thumbnail thumbnail-team no-border no-padding\">\n					<div class=\"media\">\n						<img class=\"pb-img-edit\" src=\"https://lararent.alfafox.site/rentit/assets/img/preview/team/team-270x270x4.jpg\" alt=\"\">\n					</div>\n					<div class=\"caption\">\n						<h4 class=\"caption-title edit\" >Taufiq Firdos<small>Support team</small></h4>\n						<ul class=\"social-icons\">\n							<li><a href=\"#\" class=\"facebook\"><i class=\"fa fa-facebook\"></i></a></li>\n							<li><a href=\"#\" class=\"twitter\"><i class=\"fa fa-twitter\"></i></a></li>\n							<li><a href=\"#\" class=\"instagram\"><i class=\"fa fa-instagram\"></i></a></li>\n							<li><a href=\"#\" class=\"pinterest\"><i class=\"fa fa-pinterest\"></i></a></li>\n						</ul>\n						<div class=\"caption-text edit\" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ullamcorper, quam vel viverra laoreet, nibh libero adipiscing diam, sit amet dictum sem nisi ut sapien.</div>\n					</div>\n				</div>\n			</div>\n		</div>\n\n		<div class=\"row edit\" >\n			<div class=\"col-md-4 edit \" >\n				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis blandit elementum. Nullam volutpat vestibulum molestie. Duis ac sapien consequat, sollicitudin diam vitae, fringilla lectus.</p>\n			</div>\n			<div class=\"col-md-4 edit\" >\n				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis blandit elementum. Nullam volutpat vestibulum molestie. Duis ac sapien consequat, sollicitudin diam vitae, fringilla lectus.</p>\n			</div>\n			<div class=\"col-md-4 edit\" >\n				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis blandit elementum. Nullam volutpat vestibulum molestie. Duis ac sapien consequat, sollicitudin diam vitae, fringilla lectus.</p>\n			</div>\n		</div>\n\n	</div>\n\n</section>', '', 'en', '2018-11-30 14:09:27', '2019-01-11 12:19:41'),
(28, 28, '', '', 'en', '2018-12-01 08:23:45', '2018-12-01 08:23:45'),
(31, 31, '', '', 'en', '2018-12-03 16:21:37', '2018-12-03 16:21:37'),
(32, 32, '', '', 'en', '2018-12-20 18:53:01', '2018-12-20 18:53:01'),
(33, 33, '<section id=\"contact_us__0\" class=\"edit page-section color  pb-module-section\" >\n	<div class=\"edit container\" >\n\n		<div class=\"edit row\" >\n\n			<div class=\"edit col-md-4\" >\n				<div class=\"edit contact-info\" >\n\n					<h2 class=\"edit block-title\" ><span>Contact Us</span></h2>\n\n					<div class=\"edit media-list\" >\n						<div class=\"edit media\" >\n							<i class=\"edit pull-left fa fa-home\" ></i>\n							<div class=\"edit media-body\" >\n								<strong>Address:</strong><br>\n								987 Main st. New York, NY, 00001, U.S.A\n							</div>\n						</div>\n						<div class=\"edit media\" >\n							<i class=\"edit pull-left fa fa-phone\" ></i>\n							<div class=\"edit media-body\" >\n								<strong>Telephone:</strong><br>\n								(012) 345-7689\n							</div>\n						</div>\n						<div class=\"edit media\" >\n							<i class=\"edit pull-left fa fa-envelope-o\" ></i>\n							<div class=\"edit media-body\" >\n								<strong>Fax:</strong><br>\n								0123456789\n							</div>\n						</div>\n						<div class=\"edit media\" >\n							<div class=\"edit media-body\" >\n								Phasellus pellentesque purus in massa aenean in pede phasellus libero ac tellus pellentesque semper.\n							</div>\n						</div>\n						<div class=\"edit media\" >\n							<div class=\"edit media-body\" >\n								<strong>Customer Service:</strong><br>\n								<a href=\"mailto:hello@rentit.com\">hello@rentit.com</a>\n							</div>\n						</div>\n						<div class=\"edit media\" >\n							<div class=\"edit media-body\" >\n								<strong>Returns and Refunds:</strong><br>\n								<a href=\"mailto:hello@rentit.com\">hello@rentit.com</a>\n							</div>\n						</div>\n					</div>\n\n				</div>\n			</div>\n\n			<div class=\"edit col-md-8 text-left\" >\n\n				<h2 class=\"edit block-title\" ><span>Contact Form</span></h2>\n\n				<!-- Contact form -->\n				<form name=\"contact-form\" method=\"post\" action=\"#\" class=\"edit contact-form\" id=\"contact-form\" >\n\n					<div class=\"edit outer required\" >\n						<div class=\"edit form-group af-inner\" >\n							<label class=\"edit sr-only\" for=\"name\" >Name</label>\n							<input type=\"text\" name=\"name\" id=\"name\" placeholder=\"Name\" value=\"\" size=\"30\" data-toggle=\"tooltip\" title=\"\" class=\"edit form-control placeholder\" data-original-title=\"Name is required\" >\n						</div>\n					</div>\n\n					<div class=\"edit outer required\" >\n						<div class=\"edit form-group af-inner\" >\n							<label class=\"edit sr-only\" for=\"email\" >Email</label>\n							<input type=\"text\" name=\"email\" id=\"email\" placeholder=\"Email\" value=\"\" size=\"30\" data-toggle=\"tooltip\" title=\"\" class=\"edit form-control placeholder\" data-original-title=\"Email is required\" >\n						</div>\n					</div>\n\n					<div class=\"edit outer required\" >\n						<div class=\"edit form-group af-inner\" >\n							<label class=\"edit sr-only\" for=\"subject\" >Subject</label>\n							<input type=\"text\" name=\"subject\" id=\"subject\" placeholder=\"Subject\" value=\"\" size=\"30\" data-toggle=\"tooltip\" title=\"\" class=\"edit form-control placeholder\" data-original-title=\"Subject is required\" >\n						</div>\n					</div>\n\n					<div class=\"edit form-group af-inner\" >\n						<label class=\"edit sr-only\" for=\"input-message\" >Message</label>\n						<textarea name=\"message\" id=\"input-message\" placeholder=\"Message\" rows=\"4\" cols=\"50\" data-toggle=\"tooltip\" title=\"\" class=\"edit form-control placeholder\" data-original-title=\"Message is required\" ></textarea>\n					</div>\n\n					<div class=\"edit outer required\" >\n						<div class=\"edit form-group af-inner\" >\n							<input type=\"submit\" name=\"submit\" class=\"edit form-button form-button-submit btn btn-theme btn-theme-dark\" id=\"submit_btn\" value=\"Send message\" >\n						</div>\n					</div>\n\n				</form>\n				<!-- /Contact form -->\n\n			</div>\n\n		</div>\n\n	</div>\n</section>', '', 'en', '2018-12-21 09:04:22', '2018-12-21 09:04:22'),
(34, 34, '<section id=\"contact_us_map__0\" class=\"page-section no-padding  pb-module-section\">\n\n    <div class=\"container full-width\">\n\n        <!-- Google map -->\n        <div class=\"google-map\">\n            <div id=\"map-canvas\"></div>\n\n        </div>\n        <!-- /Google map -->\n\n    </div>\n    <script type=\"text/javascript\">\n        var\n            mapObject,\n            markers = [],\n            markersData =              {\n            \'all\': [\n\n			                        {\n                        name: \'Volkswagen Polo\',\n                        location_latitude: 34.7720133,\n                        location_longitude:  32.429736899999966,\n                        map_image_url: \'https://lararent.alfafox.site/uploads/2018/09/10/Screenshot_15-370x220.png\',\n                        name_point: \'Volkswagen Polo\',\n                        fa_icon: \'http://rentit.wpmix.net/wp-content/themes/rentit/img/icon-google-map.png\',\n\n                        description_point: \'\',\n                        icons: \'{\"fa-car\":\"2018\",\"fa-dashboard\":\"Diesel\",\"fa-cog\":\"Auto\"}\',\n                        url_point: \'https://lararent.alfafox.site/products/volkswagen-polo\',\n                        transmission: \'Auto\',\n                        engine: \'Diesel\',\n                        year:\'2015\',\n                        moreinfo: \'Rent It\', \n                        },\n						                        {\n                        name: \'Renoult Megane\',\n                        location_latitude: 35.0352421,\n                        location_longitude:  33.986148999999955,\n                        map_image_url: \'https://lararent.alfafox.site/uploads/2018/09/10/Kaptur-packshot_1536x864.ximg.l_full_m.smart-370x220.jpg\',\n                        name_point: \'Renoult Megane\',\n                        fa_icon: \'http://rentit.wpmix.net/wp-content/themes/rentit/img/icon-google-map.png\',\n\n                        description_point: \'\',\n                        icons: \'{\"fa-car\":\"2014\",\"fa-dashboard\":\"Diesel\",\"fa-cog\":\"Auto\"}\',\n                        url_point: \'https://lararent.alfafox.site/products/renoult-megane\',\n                        transmission: \'Auto\',\n                        engine: \'Diesel\',\n                        year:\'2015\',\n                        moreinfo: \'Rent It\', \n                        },\n						                        {\n                        name: \'Honda Civic Elegance\',\n                        location_latitude: 35.126413,\n                        location_longitude:  33.429858999999965,\n                        map_image_url: \'https://lararent.alfafox.site/uploads/2018/09/10/Screenshot_12-370x220.png\',\n                        name_point: \'Honda Civic Elegance\',\n                        fa_icon: \'http://rentit.wpmix.net/wp-content/themes/rentit/img/icon-google-map.png\',\n\n                        description_point: \'\',\n                        icons: \'{\"fa-car\":\"2013\",\"fa-dashboard\":\"Diesel\",\"fa-cog\":\"Auto\"}\',\n                        url_point: \'https://lararent.alfafox.site/products/honda-civic-elegance\',\n                        transmission: \'Auto\',\n                        engine: \'Diesel\',\n                        year:\'2015\',\n                        moreinfo: \'Rent It\', \n                        },\n						                        {\n                        name: \'VW Polo 1.6 TDI Comfortline\',\n                        location_latitude: 34.895722607702524,\n                        location_longitude:  33.09210523222657,\n                        map_image_url: \'https://lararent.alfafox.site/uploads/2018/09/10/Screenshot_10-370x220.png\',\n                        name_point: \'VW Polo 1.6 TDI Comfortline\',\n                        fa_icon: \'http://rentit.wpmix.net/wp-content/themes/rentit/img/icon-google-map.png\',\n\n                        description_point: \'\',\n                        icons: \'{\"fa-car\":\"2013\",\"fa-dashboard\":\"Diesel\",\"fa-cog\":\"Auto\"}\',\n                        url_point: \'https://lararent.alfafox.site/products/vw-polo-1-6-tdi-comfortline\',\n                        transmission: \'Auto\',\n                        engine: \'Diesel\',\n                        year:\'2015\',\n                        moreinfo: \'Rent It\', \n                        },\n						                        {\n                        name: \'TOYOTA COROLLA 1.6 ELEGANT\',\n                        location_latitude: 34.76385829994759,\n                        location_longitude:  33.029500659277346,\n                        map_image_url: \'https://lararent.alfafox.site/uploads/2018/08/16/01-2019-lamborghini-urus-oem-370x220.jpg\',\n                        name_point: \'TOYOTA COROLLA 1.6 ELEGANT\',\n                        fa_icon: \'http://rentit.wpmix.net/wp-content/themes/rentit/img/icon-google-map.png\',\n\n                        description_point: \'\',\n                        icons: \'{\"fa-car\":\"2013\",\"fa-dashboard\":\"Diesel\",\"fa-cog\":\"Auto\"}\',\n                        url_point: \'https://lararent.alfafox.site/products/toyota-corolla-1-6-elegant\',\n                        transmission: \'Auto\',\n                        engine: \'Diesel\',\n                        year:\'2015\',\n                        moreinfo: \'Rent It\', \n                        },\n						\n\n            ]\n\n			\n\n        }\n        ;\n\n\n        function initialize_map() {\n\n\n            loadScript(\"http://rentit.wpmix.net/wp-content/themes/rentit/js/infobox.js\", after_load);\n\n        }\n\n        function after_load() {\n            var global_scrollwheel = false;\n            var markerClusterer = null;\n            var markerCLuster;\n            var Clusterer;\n\n            initialize_new2();\n        }\n\n        function loadScript(src, callback) {\n            var s,\n                r,\n                t;\n            r = false;\n            s = document.createElement(\'script\');\n            s.type = \'text/javascript\';\n            s.src = src;\n            s.onload = s.onreadystatechange = function () {\n                ////console.log( this.readyState ); //uncomment this line to see which ready states are called.\n                if (!r && (!this.readyState || this.readyState == \'complete\')) {\n                    r = true;\n                    callback();\n                }\n            };\n            t = document.getElementsByTagName(\'script\')[0];\n            t.parentNode.insertBefore(s, t);\n\n        }\n    </script>\n</section>', '', 'en', '2018-12-21 09:04:22', '2018-12-21 09:04:22'),
(36, 36, '', '', 'en', '2019-01-06 11:42:35', '2019-01-06 11:42:35'),
(37, 37, '<section id=\"contact_us_faq__0\" class=\"edit page-section contact dark pb-module-section ui-sortable-handle\" >\n    <div class=\"edit container\" >\n\n        <!-- Get in touch -->\n\n        <h2 class=\"edit section-title\" >\n            <small class=\"edit\" >Feel Free to Say Hello!</small>\n            <span class=\"edit\" >Get in Touch With Us</span>\n        </h2>\n\n        <div class=\"edit row\" >\n            <div class=\"edit col-md-6\" >\n                <!-- Contact form -->\n                <form name=\"contact-form\" method=\"post\" action=\"#\" class=\"edit contact-form alt\" id=\"contact-form\" >\n\n                    <div class=\"edit row\" >\n                        <div class=\"edit col-md-6\" >\n\n                            <div class=\"edit outer required\" >\n                                <div class=\"edit form-group af-inner has-icon\" >\n                                    <label class=\"edit sr-only\" for=\"name\" >Name</label>\n                                    <input type=\"text\" name=\"name\" id=\"name\" placeholder=\"Name\" value=\"\" size=\"30\" data-toggle=\"tooltip\" title=\"\" class=\"edit form-control placeholder\" data-original-title=\"Name is required\" >\n                                    <span class=\"edit form-control-icon\" ><i class=\"edit fa fa-user\" ></i></span>\n                                </div>\n                            </div>\n\n                        </div>\n                        <div class=\"edit col-md-6\" >\n\n                            <div class=\"edit outer required\" >\n                                <div class=\"edit form-group af-inner has-icon\" >\n                                    <label class=\"edit sr-only\" for=\"email\" >Email</label>\n                                    <input type=\"text\" name=\"email\" id=\"email\" placeholder=\"Email\" value=\"\" size=\"30\" data-toggle=\"tooltip\" title=\"\" class=\"edit form-control placeholder\" data-original-title=\"Email is required\" >\n                                    <span class=\"edit form-control-icon\" ><i class=\"edit fa fa-envelope\" ></i></span>\n                                </div>\n                            </div>\n\n                        </div>\n                    </div>\n\n                    <div class=\"edit form-group af-inner has-icon\" >\n                        <label class=\"edit sr-only\" for=\"input-message\" >Message</label>\n                        <textarea name=\"message\" id=\"input-message\" placeholder=\"Message\" rows=\"4\" cols=\"50\" data-toggle=\"tooltip\" title=\"\" class=\"edit form-control placeholder\" data-original-title=\"Message is required\" ></textarea>\n                        <span class=\"edit form-control-icon\" ><i class=\"edit fa fa-bars\" ></i></span>\n                    </div>\n\n                    <div class=\"edit outer required\" >\n                        <div class=\"edit form-group af-inner\" >\n                            <input type=\"submit\" name=\"submit\" class=\"edit form-button form-button-submit btn btn-block btn-theme\" id=\"submit_btn\" value=\"Send message\" >\n                        </div>\n                    </div>\n\n                </form>\n                <!-- /Contact form -->\n            </div>\n            <div class=\"edit col-md-6\" >\n\n                <p class=\"edit edit\" >This is Photoshop\'s version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum.</p>\n\n                <ul class=\"edit media-list contact-list\" >\n                    <li class=\"edit media\" >\n                        <div class=\"edit media-left\" ><i class=\"edit fa fa-home\" ></i></div>\n                        <div class=\"edit media-body \" >Adress: 1600 Pennsylvania Ave NW, Washington, D.C.</div>\n                    </li>\n                    <li class=\"edit media\" >\n                        <div class=\"edit media-left\" ><i class=\"edit fa fa\" ></i></div>\n                        <div class=\"edit media-body\" >DC 20500, ABD</div>\n                    </li>\n                    <li class=\"edit media\" >\n                        <div class=\"edit media-left\" ><i class=\"edit fa fa-phone\" ></i></div>\n                        <div class=\"edit media-body\" >Support Phone: 01865 339665</div>\n                    </li>\n                    <li class=\"edit media\" >\n                        <div class=\"edit media-left\" ><i class=\"edit fa fa-envelope\" ></i></div>\n                        <div class=\"edit media-body\" >E mails: info@example.com</div>\n                    </li>\n                    <li class=\"edit media\" >\n                        <div class=\"edit media-left\" ><i class=\"edit fa fa-clock-o\" ></i></div>\n                        <div class=\"edit media-body\" >Working Hours: 09:30-21:00 except on Sundays</div>\n                    </li>\n                    <li class=\"edit media\" >\n                        <div class=\"edit media-left\" ><i class=\"edit fa fa-map-marker\" ></i></div>\n                        <div class=\"edit media-body\" >View on The Map</div>\n                    </li>\n                </ul>\n\n            </div>\n        </div>\n\n        <!-- /Get in touch -->\n\n    </div></section>', '', 'en', '2019-01-07 09:30:59', '2019-01-07 09:46:22'),
(38, 39, '<section id=\"<?php  echo $id ;?>\" class=\"page-section breadcrumbs\n<?php  echo $text_position; ?>\n pb-module-section\">\n\n	<div class=\"container\">\n		<div class=\"page-header\">\n			<h1><?php  echo e($page->title ?? \'\') ?></h1>\n		</div>\n		<ul class=\"breadcrumb\">\n			<li><a href=\"<?php  echo url(\'/\'); ?>\"><?php  echo __(\'Home\'); ?> </a></li>\n			<li class=\"active\"><?php  echo e($page->title ?? \'\') ?></li>\n		</ul>\n	</div>\n</section>', 'a:2:{s:9:\"alignment\";s:15:\"alignment-right\";s:10:\"page_title\";s:0:\"\";}', 'en', '2019-01-07 10:07:12', '2019-01-07 10:09:31');

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `options` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'blogdescription', 'Laravel Rentit  system', '2018-08-27 14:32:41', '2018-08-27 14:48:02'),
(2, 'default_role', 'subscriber', '2018-08-27 14:32:41', '2018-08-27 14:39:45'),
(3, 'timezone_string', 'UTC+0', '2018-08-27 14:32:41', '2018-08-27 14:39:45'),
(4, 'WPLANG', 'dzo', '2018-08-27 14:32:41', '2018-08-27 14:32:41'),
(5, 'show_on_front', 'page', '2018-08-27 14:32:41', '2018-08-27 14:32:41'),
(6, 'page_on_front', '10386', '2018-08-27 14:32:41', '2018-08-27 14:32:41'),
(7, 'page_for_posts', '0', '2018-08-27 14:32:41', '2018-08-27 14:32:41'),
(8, 'blogname', 'Rentit', '2018-08-27 14:48:02', '2018-08-27 14:48:02'),
(9, 'admin_email', 'jthemesonline@gmail.com', '2018-08-27 14:50:18', '2019-01-11 11:05:51'),
(10, 'LANG', 'en', '2018-08-28 09:04:10', '2018-08-29 10:13:53'),
(11, 'custom_langs', '{\"code\":[\"en\",\"ru\"],\"name\":[\"ENG\",\"\\u0420\\u0423\\u0421\"]}', '2018-08-28 09:04:10', '2019-01-16 08:21:56'),
(12, 'ecommerce_cheque_settings', '', '2018-09-04 15:34:34', '2018-09-04 15:34:34'),
(13, 'ecommerce_stripe_settings', '', '2018-09-07 13:31:52', '2018-09-07 13:31:52'),
(14, 'posts_per_page', '2', '2018-09-10 15:14:57', '2018-09-10 15:14:57'),
(15, 'ecommerce_currency_options', '', '2018-09-11 09:17:41', '2018-09-11 09:17:41'),
(16, 'ecommerce_PayPal_settings', '', '2019-01-10 10:47:28', '2019-01-10 10:47:28'),
(17, 'seo_title', '%controller_title% > %site_title%', '2019-01-11 11:05:51', '2019-01-11 11:05:51'),
(18, 'q', '/admin/options', '2019-01-11 11:05:51', '2019-01-11 11:05:51');

CREATE TABLE IF NOT EXISTS `option_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_id` int(10) UNSIGNED NOT NULL,
  `translation_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_translations_option_id_locale_unique` (`option_id`,`locale`),
  KEY `option_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `option_translations` (`id`, `option_id`, `translation_value`, `locale`, `created_at`, `updated_at`) VALUES
(1, 12, 'a:5:{s:7:\"enabled\";s:2:\"on\";s:5:\"title\";s:15:\"Offline Payment\";s:11:\"description\";s:98:\"Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.\";s:12:\"instructions\";N;s:1:\"q\";s:31:\"/admin/ecommerce/payment/cheque\";}', 'en', '2018-09-04 15:34:34', '2019-01-09 09:32:24'),
(2, 12, 'a:4:{s:14:\"cheque_enabled\";s:2:\"on\";s:12:\"cheque_title\";s:27:\"Чековый платеж\";s:18:\"cheque_description\";s:191:\"Пожалуйста, отправьте чек на имя магазина, магазин, магазин, магазин / графство, почтовый индекс магазина\";s:19:\"cheque_instructions\";N;}', 'ru', '2018-09-04 16:00:44', '2018-09-04 16:00:44'),
(3, 13, 'a:7:{s:7:\"enabled\";s:2:\"on\";s:5:\"title\";s:15:\"Stripe payments\";s:16:\"enable_test_mode\";s:2:\"on\";s:14:\"STRIPE_PUB_KEY\";N;s:17:\"STRIPE_SECRET_KEY\";N;s:11:\"description\";s:39:\"you can pay via card like visa (stripe)\";s:12:\"instructions\";N;}', 'en', '2018-09-07 13:31:52', '2018-09-10 10:56:02'),
(4, 15, 'a:6:{s:8:\"currency\";s:1:\"$\";s:13:\"currency_code\";s:3:\"usd\";s:12:\"currency_pos\";s:10:\"left_space\";s:18:\"price_thousand_sep\";s:1:\",\";s:17:\"price_decimal_sep\";s:1:\".\";s:18:\"price_num_decimals\";s:1:\"2\";}', 'en', '2018-09-11 09:17:41', '2018-09-21 09:42:33'),
(5, 16, 'a:7:{s:7:\"enabled\";s:2:\"on\";s:5:\"title\";s:15:\"PayPal payments\";s:16:\"enable_test_mode\";s:2:\"on\";s:5:\"email\";s:30:\"leonn366-facilitator@gmail.com\";s:11:\"description\";s:39:\"you can pay via card like visa (stripe)\";s:12:\"instructions\";N;s:1:\"q\";s:31:\"/admin/ecommerce/payment/PayPal\";}', 'en', '2019-01-10 10:47:28', '2019-01-10 19:12:11');

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_alias_unique` (`alias`),
  KEY `pages_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `pages` (`id`, `alias`, `status`, `img`, `user_id`, `deleted_at`, `created_at`, `updated_at`, `published_at`) VALUES
(1, 'about-us', 'published', '', 1, NULL, '2018-10-25 07:10:40', '2018-10-25 07:10:40', '2018-10-25'),
(2, 'test', 'published', '', 1, '2018-11-30 15:52:09', '2018-11-13 10:37:05', '2018-11-30 15:52:09', '2018-11-13'),
(3, 'login', 'published', '', 1, '2018-11-30 15:48:31', '2018-11-30 15:44:24', '2018-11-30 15:48:31', '2018-11-30'),
(4, '', 'published', '', 1, '2018-12-01 08:15:28', '2018-11-30 15:52:15', '2018-12-01 08:15:28', '2018-11-30'),
(5, 'login-auth', 'published', '', 1, NULL, '2018-12-01 08:16:22', '2018-12-01 08:16:22', '2018-12-01'),
(6, 'contact-us', 'published', '', 1, NULL, '2018-12-20 18:47:40', '2018-12-20 18:47:40', '2018-12-20'),
(7, 'faqs', 'published', '', 1, NULL, '2019-01-06 10:05:18', '2019-01-07 10:13:20', '2019-01-06');

CREATE TABLE IF NOT EXISTS `page_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`),
  KEY `page_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `page_translations` (`id`, `page_id`, `title`, `text`, `keywords`, `meta_desc`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'About us', '', 'About us', 'About us', 'en', '2018-10-25 07:10:40', '2019-01-11 12:18:40'),
(2, 5, 'Login', '', 'Login', 'Login', 'en', '2018-12-01 08:16:22', '2018-12-01 08:23:18'),
(3, 6, 'CONTACT US', '', '', 'CONTACT US', 'en', '2018-12-20 18:47:40', '2018-12-20 18:47:40'),
(4, 7, 'FAQS', '', 'FAQ', 'FAQ', 'en', '2019-01-06 10:05:18', '2019-01-07 10:13:12');

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('lopatys@gmail.com', '$2y$10$5GX/S8yvGB.aWRJxdExhbuqZSvwMJFUy.dCulavCcCBVpO6iuu/Fe', '2018-07-13 08:43:34');

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plugins_alias_unique` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `plugins` (`id`, `alias`, `activated`, `created_at`, `updated_at`) VALUES
(14, 'eCommerce', 1, '2018-07-20 14:07:28', '2018-10-15 14:39:40'),
(16, 'PageBuilder', 1, '2018-10-31 08:05:10', '2018-12-01 08:26:24'),
(17, 'LocoTranslate', 1, '2018-12-05 17:12:51', '2018-12-06 07:01:50');

CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolios_alias_unique` (`alias`),
  KEY `portfolios_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `portfolios` (`id`, `alias`, `status`, `img`, `user_id`, `deleted_at`, `created_at`, `updated_at`, `published_at`) VALUES
(2, 'project-title-2', 'published', '36', 1, NULL, '2018-10-16 07:14:19', '2018-10-18 06:53:58', '2018-10-16'),
(3, 'project-title-1', 'published', '37', 1, NULL, '2018-10-16 14:51:27', '2018-10-18 06:53:41', '2018-10-16'),
(4, 'project-title-2-cloned', 'published', '32', 1, NULL, '2018-10-22 09:02:25', '2018-10-23 09:58:23', '2018-10-22'),
(5, 'project-title-3', 'published', '33', 1, NULL, '2018-10-22 09:13:34', '2018-10-23 09:58:07', '2018-10-22'),
(6, 'project-title-4', 'published', '34', 1, NULL, '2018-10-22 09:15:56', '2018-10-23 09:57:38', '2018-10-22'),
(7, 'project-title-5', 'published', '35', 1, NULL, '2018-10-22 09:15:58', '2018-10-23 09:56:51', '2018-10-22'),
(8, 'project-title-5-1', 'published', '36', 1, NULL, '2018-10-22 09:17:29', '2018-10-22 09:17:29', '2018-10-22'),
(9, 'project-title-5-2', 'published', '37', 1, NULL, '2018-10-22 09:17:34', '2018-10-23 09:56:20', '2018-10-22'),
(10, 'project-title-5-3', 'published', '36', 1, NULL, '2018-10-22 09:17:37', '2018-10-22 09:17:37', '2018-10-22'),
(11, 'project-title-4-1', 'published', '30', 1, NULL, '2018-10-23 09:39:30', '2018-10-23 09:59:20', '2018-10-23'),
(12, 'project-title-2-cloned-1', 'published', '31', 1, NULL, '2018-10-23 09:39:31', '2018-10-23 10:01:48', '2018-10-23'),
(13, 'project-title-5-2-1', 'published', '36', 1, NULL, '2018-10-23 09:39:56', '2018-10-23 09:39:56', '2018-10-23');

CREATE TABLE IF NOT EXISTS `portfolio_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `portfolio_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolio_translations_portfolio_id_locale_unique` (`portfolio_id`,`locale`),
  KEY `portfolio_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `portfolio_translations` (`id`, `portfolio_id`, `title`, `text`, `details`, `keywords`, `meta_desc`, `locale`, `created_at`, `updated_at`) VALUES
(6, 3, 'PROJECT TITLE 1', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'PROJECT', 'PROJECT', 'en', '2018-10-17 10:10:31', '2018-10-18 06:50:46'),
(7, 2, 'PROJECT TITLE 2', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-17 10:11:10', '2018-10-17 10:11:10'),
(8, 4, 'PROJECT TITLE 2 cloned', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-22 09:02:25', '2018-10-22 09:02:25'),
(9, 5, 'PROJECT TITLE 2 cloned', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-22 09:13:34', '2018-10-22 09:13:34'),
(10, 6, 'PROJECT TITLE 4', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-22 09:15:56', '2018-10-23 09:57:38'),
(11, 7, 'PORTFOLIO', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-22 09:15:58', '2018-10-24 15:06:02'),
(12, 8, 'PROJECT TITLE 2 cloned 3 2', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-22 09:17:29', '2018-10-22 09:17:29'),
(13, 9, 'PROJECT TITLE', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-22 09:17:34', '2018-10-23 09:55:43'),
(14, 10, 'PROJECT TITLE 2 cloned 3 3 2 1', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-22 09:17:37', '2018-10-22 09:17:37'),
(15, 11, 'PROJECT TITLE', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-23 09:39:30', '2018-10-23 09:59:25'),
(16, 12, 'PROJECT TITLE 2 cloned 1', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>', '', 'jhkl', 'kjl', 'en', '2018-10-23 09:39:31', '2018-10-23 09:39:31'),
(17, 13, 'PROJECT TITLE 2', '<p>Sanctus sea sed takimata ut vero voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>\r\n<p>Sanctus sea sed takimata ut vero voluptua. At vero eos et accusam et justo duo dolores et ea rebum</p>', '', 'PROJECT TITLE 2', 'PROJECT TITLE 2', 'en', '2018-10-23 09:39:56', '2018-10-23 10:04:35');

CREATE TABLE IF NOT EXISTS `por_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `por_categories_alias_unique` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `por_categories` (`id`, `parent_id`, `alias`, `img`, `created_at`, `updated_at`) VALUES
(3, 0, 'miscellaneous', 0, '2018-10-17 09:36:49', '2018-10-17 09:36:49'),
(4, 0, 'accessories', 0, '2018-10-17 09:36:59', '2018-10-17 09:36:59'),
(5, 0, 'dresses-and-suits', 0, '2018-10-17 09:37:08', '2018-10-17 09:37:08');

CREATE TABLE IF NOT EXISTS `por_category_portfolio` (
  `por_category_id` int(10) UNSIGNED NOT NULL,
  `portfolio_id` int(10) UNSIGNED NOT NULL,
  KEY `por_category_portfolio_por_category_id_foreign` (`por_category_id`),
  KEY `por_category_portfolio_portfolio_id_foreign` (`portfolio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `por_category_portfolio` (`por_category_id`, `portfolio_id`) VALUES
(3, 2),
(4, 3),
(3, 3),
(3, 4),
(3, 5),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(4, 7),
(4, 6),
(5, 6);

CREATE TABLE IF NOT EXISTS `por_category_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `por_category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `por_category_translations_por_category_id_locale_unique` (`por_category_id`,`locale`),
  KEY `por_category_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `por_category_translations` (`id`, `por_category_id`, `title`, `keywords`, `description`, `locale`, `created_at`, `updated_at`) VALUES
(3, 3, 'Miscellaneous', '', '', 'en', '2018-10-17 09:36:49', '2018-10-17 09:36:49'),
(4, 4, 'Accessories', '', '', 'en', '2018-10-17 09:36:59', '2018-10-17 09:36:59'),
(5, 5, 'Dresses and Suits', '', '', 'en', '2018-10-17 09:37:08', '2018-10-17 09:37:08');

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_alias_unique` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `tags` (`id`, `alias`, `created_at`, `updated_at`) VALUES
(1, 'bmw', '2018-07-31 13:56:02', '2018-07-31 13:56:02'),
(2, 'rock', '2018-08-01 08:32:38', '2018-08-01 08:32:38'),
(12, 'blog', '2018-08-06 09:41:09', '2018-08-06 09:41:09');

CREATE TABLE IF NOT EXISTS `tag_post` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_post_tag_id_foreign` (`tag_id`),
  KEY `tag_post_post_id_foreign` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `tag_post` (`id`, `tag_id`, `post_id`, `created_at`, `updated_at`) VALUES
(5, 1, 5, NULL, NULL),
(9, 12, 3, NULL, NULL);

CREATE TABLE IF NOT EXISTS `tag_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_translations_tag_id_locale_unique` (`tag_id`,`locale`),
  KEY `tag_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `tag_translations` (`id`, `tag_id`, `title`, `keywords`, `description`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'BMW2', '', '', 'en', '2018-07-31 13:56:02', '2018-08-06 06:00:24'),
(2, 2, 'rock', '', '', 'en', '2018-08-01 08:32:38', '2018-08-01 08:32:38'),
(8, 12, 'blog', '', '', 'en', '2018-08-06 09:41:09', '2018-08-06 09:41:09');

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

REPLACE INTO `test` (`id`) VALUES
(1),
(2),
(3),
(6),
(8),
(9),
(12);

CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `sitings` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `themes_alias_unique` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `themes` (`id`, `alias`, `activated`, `sitings`, `created_at`, `updated_at`) VALUES
(6, 'RentIt', 1, '', '2018-07-23 09:29:03', '2018-12-14 06:48:53'),
(7, 'Vetrov', 0, '', '2018-07-23 09:29:13', '2018-12-14 06:48:53');

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sidebar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `widget_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callback` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `widgets` (`id`, `sidebar`, `position`, `widget_id`, `callback`, `created_at`, `updated_at`) VALUES
(10, 'rentit-sidebar', 3, '2', 'Corp\\Themes\\RentIt\\Widgets\\PostsWidgets', '2018-07-25 17:03:27', '2018-11-12 10:54:33'),
(11, 'rentit-sidebar', 0, '2', 'Corp\\Themes\\RentIt\\Widgets\\CategoriesWidgets', '2018-07-25 17:03:50', '2018-11-13 09:56:22'),
(12, 'rentit-sidebar', 2, '2', 'Corp\\Themes\\RentIt\\Widgets\\ArchiveWidgets', '2018-07-31 10:27:54', '2018-11-12 10:54:33'),
(13, 'rentit-sidebar', 4, '2', 'Corp\\Themes\\RentIt\\Widgets\\FlickrImagesWidget', '2018-07-31 11:28:42', '2018-10-15 09:37:26'),
(14, 'rentit-sidebar', 8, '2', 'Corp\\Themes\\RentIt\\Widgets\\TwitterWidget', '2018-07-31 12:41:51', '2018-11-13 08:40:10'),
(19, 'rentit-sidebar', 6, '2', 'Corp\\Themes\\RentIt\\Widgets\\TagsWidgets', '2018-08-01 12:44:57', '2018-10-15 09:37:26'),
(22, 'rentit-sidebar', 5, '2', 'Corp\\Themes\\RentIt\\Widgets\\CategoriesWidgets', '2018-08-02 13:30:47', '2018-10-15 09:37:26'),
(25, 'rentit-footer-sidebar', 0, '2', 'Corp\\Themes\\RentIt\\Widgets\\AboutUsWidget', '2018-08-02 14:31:56', '2018-11-08 15:54:33'),
(26, 'rentit-footer-sidebar', 1, '2', 'Corp\\Themes\\RentIt\\Widgets\\NewsLetterWidget', '2018-08-03 10:32:15', '2018-11-08 15:54:33'),
(27, 'rentit-footer-sidebar', 2, '2', 'Corp\\Themes\\RentIt\\Widgets\\MenuWidget', '2018-08-03 10:36:15', '2018-08-07 07:13:28'),
(28, 'rentit-footer-sidebar', 3, '2', 'Corp\\Themes\\RentIt\\Widgets\\TagsWidgets', '2018-08-03 10:36:31', '2018-08-06 14:28:10'),
(29, 'rentit-sidebar-shop', 0, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\ProductFilter', '2018-09-27 08:59:22', '2018-10-05 09:09:25'),
(30, 'rentit-sidebar-shop', 1, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\PriceFilter', '2018-09-28 09:56:25', '2018-09-28 09:56:25'),
(32, 'rentit-sidebar-shop', 2, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\Testimonials', '2018-09-28 14:41:42', '2018-10-01 10:01:22'),
(33, 'rentit-sidebar-shop', 3, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\HelpingCenter', '2018-09-28 14:45:34', '2018-10-01 10:27:26'),
(34, 'rentit-single-product', 1, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\Testimonials', '2018-10-01 10:20:18', '2018-10-01 10:27:26'),
(35, 'rentit-single-product', 2, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\HelpingCenter', '2018-10-01 10:20:36', '2018-10-01 10:27:26'),
(36, 'rentit-single-product', 0, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\DetailReservation', '2018-10-01 10:27:25', '2018-10-01 10:27:54'),
(37, 'rentit-sidebar', 1, '2', 'Corp\\Themes\\RentIt\\Widgets\\SearchWidget', '2018-10-15 09:37:02', '2018-11-13 09:56:22'),
(39, 'rentit-sidebar', 7, '2', 'Corp\\Themes\\RentIt\\Widgets\\FlickrImagesWidget', '2018-11-13 08:40:09', '2019-01-11 17:42:52'),
(41, 'rentit-single-page', 0, '2', 'Corp\\Themes\\RentIt\\Widgets\\SearchWidget', '2019-01-07 09:36:48', '2019-01-07 09:36:49'),
(42, 'rentit-single-page', 1, '2', 'Corp\\Themes\\RentIt\\Widgets\\CategoriesWidgets', '2019-01-07 09:36:58', '2019-01-07 09:37:36'),
(43, 'rentit-single-page', 2, '2', 'Corp\\Themes\\RentIt\\Widgets\\Product\\HelpingCenter', '2019-01-07 09:37:07', '2019-01-07 09:45:12');

CREATE TABLE IF NOT EXISTS `widget_translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `widget_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `output` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `widget_translations_widget_id_locale_unique` (`widget_id`,`locale`),
  KEY `widget_translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `widget_translations` (`id`, `widget_id`, `name`, `output`, `locale`, `created_at`, `updated_at`) VALUES
(11, 10, 'rentit_posts', 'a:14:{s:19:\"widget-rentit_posts\";a:1:{i:1;a:1:{s:5:\"title\";N;}}s:9:\"widget-id\";s:14:\"rentit_posts-1\";s:7:\"id_base\";s:12:\"rentit_posts\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:12:\"rentit_posts\";s:8:\"callback\";s:39:\"Corp\\Themes\\RentIt\\Widgets\\PostsWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"10\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'en', '2018-07-25 17:03:27', '2018-07-25 17:06:12'),
(12, 11, 'RentIt Categories', 'a:14:{s:17:\"widget-categories\";a:1:{i:2;a:1:{s:5:\"title\";s:10:\"categories\";}}s:9:\"widget-id\";s:12:\"categories-2\";s:7:\"id_base\";s:10:\"categories\";s:4:\"name\";s:17:\"RentIt Categories\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"2\";s:7:\"add_new\";N;s:8:\"callback\";s:44:\"Corp\\Themes\\RentIt\\Widgets\\CategoriesWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"11\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'en', '2018-07-25 17:03:50', '2018-07-25 17:04:04'),
(13, 12, 'RentIt Archive', 'a:14:{s:21:\"widget-rentit_archive\";a:1:{i:1;a:1:{s:5:\"title\";s:6:\"arhive\";}}s:9:\"widget-id\";s:16:\"rentit_archive-1\";s:7:\"id_base\";s:14:\"rentit_archive\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:14:\"RentIt Archive\";s:8:\"callback\";s:41:\"Corp\\Themes\\RentIt\\Widgets\\ArchiveWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"12\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'en', '2018-07-31 10:27:55', '2018-07-31 11:32:39'),
(14, 13, 'rentit Flickr Images', 'a:14:{s:21:\"widget-rentit_archive\";a:1:{i:1;a:3:{s:5:\"title\";s:13:\"flickr images\";s:6:\"number\";s:1:\"9\";s:7:\"user_id\";s:12:\"71865026@N00\";}}s:9:\"widget-id\";s:16:\"rentit_archive-1\";s:7:\"id_base\";s:14:\"rentit_archive\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:20:\"rentit Flickr Images\";s:8:\"callback\";s:45:\"Corp\\Themes\\RentIt\\Widgets\\FlickrImagesWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"13\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'en', '2018-07-31 11:28:42', '2018-07-31 11:50:36'),
(15, 14, 'rentit twitter', 'a:14:{s:21:\"widget-rentit_twitter\";a:1:{i:1;a:3:{s:5:\"title\";s:6:\"Tweets\";s:4:\"name\";s:6:\"evanto\";s:7:\"numbers\";s:1:\"3\";}}s:9:\"widget-id\";s:16:\"rentit_twitter-1\";s:7:\"id_base\";s:14:\"rentit_twitter\";s:4:\"name\";s:14:\"rentit twitter\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:8:\"callback\";s:40:\"Corp\\Themes\\RentIt\\Widgets\\TwitterWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"14\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'en', '2018-07-31 12:41:51', '2018-07-31 12:42:03'),
(20, 19, 'rentit Tag', 'a:14:{s:18:\"widget-rentit_tags\";a:1:{i:1;a:3:{s:5:\"title\";s:4:\"tags\";s:4:\"name\";N;s:7:\"numbers\";N;}}s:9:\"widget-id\";s:13:\"rentit_tags-1\";s:7:\"id_base\";s:11:\"rentit_tags\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:10:\"rentit Tag\";s:8:\"callback\";s:38:\"Corp\\Themes\\RentIt\\Widgets\\TagsWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"19\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'en', '2018-08-01 12:44:58', '2018-08-02 08:42:51'),
(23, 14, 'rentit twitter', 'a:14:{s:21:\"widget-rentit_twitter\";a:1:{i:1;a:3:{s:5:\"title\";s:14:\"Твиттер\";s:4:\"name\";s:6:\"evanto\";s:7:\"numbers\";s:1:\"3\";}}s:9:\"widget-id\";s:16:\"rentit_twitter-1\";s:7:\"id_base\";s:14:\"rentit_twitter\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:14:\"rentit twitter\";s:8:\"callback\";s:40:\"Corp\\Themes\\RentIt\\Widgets\\TwitterWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"14\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'ru', '2018-08-02 12:16:43', '2018-08-02 12:16:43'),
(24, 11, 'RentIt Categories', 'a:14:{s:17:\"widget-categories\";a:1:{i:2;a:1:{s:5:\"title\";s:14:\"Рубрики\";}}s:9:\"widget-id\";s:12:\"categories-2\";s:7:\"id_base\";s:10:\"categories\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"2\";s:7:\"add_new\";N;s:4:\"name\";s:17:\"RentIt Categories\";s:8:\"callback\";s:44:\"Corp\\Themes\\RentIt\\Widgets\\CategoriesWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"11\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'ru', '2018-08-02 12:19:52', '2018-08-02 12:19:52'),
(25, 12, 'RentIt Archive', 'a:14:{s:21:\"widget-rentit_archive\";a:1:{i:1;a:1:{s:5:\"title\";s:12:\"Архивы\";}}s:9:\"widget-id\";s:16:\"rentit_archive-1\";s:7:\"id_base\";s:14:\"rentit_archive\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:14:\"RentIt Archive\";s:8:\"callback\";s:41:\"Corp\\Themes\\RentIt\\Widgets\\ArchiveWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"12\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'ru', '2018-08-02 12:20:09', '2018-08-02 12:20:09'),
(26, 13, 'rentit Flickr Images', 'a:14:{s:21:\"widget-rentit_archive\";a:1:{i:1;a:3:{s:5:\"title\";s:24:\"flickr  картинки\";s:6:\"number\";s:1:\"9\";s:7:\"user_id\";s:12:\"71865026@N00\";}}s:9:\"widget-id\";s:16:\"rentit_archive-1\";s:7:\"id_base\";s:14:\"rentit_archive\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:20:\"rentit Flickr Images\";s:8:\"callback\";s:45:\"Corp\\Themes\\RentIt\\Widgets\\FlickrImagesWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"13\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'ru', '2018-08-02 12:20:23', '2018-08-02 12:20:23'),
(27, 19, 'rentit Tag', 'a:14:{s:18:\"widget-rentit_tags\";a:1:{i:1;a:1:{s:5:\"title\";s:8:\"теги\";}}s:9:\"widget-id\";s:13:\"rentit_tags-1\";s:7:\"id_base\";s:11:\"rentit_tags\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:10:\"rentit Tag\";s:8:\"callback\";s:38:\"Corp\\Themes\\RentIt\\Widgets\\TagsWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"19\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'ru', '2018-08-02 12:20:33', '2018-08-02 12:20:33'),
(28, 22, 'RentIt Categories', 'a:14:{s:17:\"widget-categories\";a:1:{i:1;a:1:{s:5:\"title\";s:8:\"gdfhdfgh\";}}s:9:\"widget-id\";s:12:\"categories-1\";s:7:\"id_base\";s:10:\"categories\";s:4:\"name\";s:17:\"RentIt Categories\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:8:\"callback\";s:44:\"Corp\\Themes\\RentIt\\Widgets\\CategoriesWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"22\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-footer-sidebar\";}', 'en', '2018-08-02 13:30:47', '2018-08-02 13:30:50'),
(31, 25, 'rentit About us', 'a:14:{s:22:\"widget-rentit_about_us\";a:1:{i:1;a:3:{s:5:\"title\";s:8:\"ABOUT US\";s:4:\"text\";s:191:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sollicitudin ultrices suscipit. Sed commodo vel mauris vel dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\";s:6:\"social\";a:2:{s:4:\"icon\";a:4:{i:0;s:11:\"fa-facebook\";i:1;s:10:\"fa-twitter\";i:2;s:12:\"fa-instagram\";i:3;s:12:\"fa-pinterest\";}s:3:\"url\";a:4:{i:0;s:20:\"https://facebook.com\";i:1;s:20:\"https://twitter.com/\";i:2;s:26:\"https://www.instagram.com/\";i:3;s:22:\"https://pinterest.com/\";}}}}s:9:\"widget-id\";s:17:\"rentit_about_us-1\";s:7:\"id_base\";s:15:\"rentit_about_us\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:15:\"rentit About us\";s:8:\"callback\";s:40:\"Corp\\Themes\\RentIt\\Widgets\\AboutUsWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"25\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-footer-sidebar\";}', 'en', '2018-08-02 14:31:56', '2018-08-02 17:43:53'),
(32, 26, 'RentIt News Letter', 'a:14:{s:25:\"widget-rentit_news_letter\";a:1:{i:1;a:6:{s:5:\"title\";s:11:\"NEWS LETTER\";s:4:\"desc\";s:56:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit.\";s:2:\"id\";s:10:\"c4d0049d45\";s:3:\"key\";s:37:\"90d7280f6c70f5b1c1c41829c8f12fac-us17\";s:12:\"placeholder \";s:32:\"Enter Your Mail and Get $10 Cash\";s:7:\"button \";s:9:\"Subscribe\";}}s:9:\"widget-id\";s:20:\"rentit_news_letter-1\";s:7:\"id_base\";s:18:\"rentit_news_letter\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:18:\"RentIt News Letter\";s:8:\"callback\";s:43:\"Corp\\Themes\\RentIt\\Widgets\\NewsLetterWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"26\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-footer-sidebar\";}', 'en', '2018-08-03 10:32:15', '2018-08-06 14:29:11'),
(33, 27, 'RentIt Menu', 'a:14:{s:18:\"widget-rentit_menu\";a:1:{i:1;a:2:{s:5:\"title\";s:11:\"INFORMATION\";s:4:\"menu\";s:1:\"2\";}}s:9:\"widget-id\";s:13:\"rentit_menu-1\";s:7:\"id_base\";s:11:\"rentit_menu\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:11:\"RentIt Menu\";s:8:\"callback\";s:37:\"Corp\\Themes\\RentIt\\Widgets\\MenuWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"27\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-footer-sidebar\";}', 'en', '2018-08-03 10:36:15', '2018-08-07 07:13:27'),
(34, 28, 'rentit Tag', 'a:14:{s:18:\"widget-rentit_tags\";a:1:{i:2;a:1:{s:5:\"title\";s:9:\"ITEM TAGS\";}}s:9:\"widget-id\";s:13:\"rentit_tags-2\";s:7:\"id_base\";s:11:\"rentit_tags\";s:4:\"name\";s:10:\"rentit Tag\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"2\";s:7:\"add_new\";N;s:8:\"callback\";s:38:\"Corp\\Themes\\RentIt\\Widgets\\TagsWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"28\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-footer-sidebar\";}', 'en', '2018-08-03 10:36:31', '2018-08-03 10:36:40'),
(35, 29, 'rentit Product Filter', 'a:14:{s:28:\"widget-rentit_productfilters\";a:1:{i:1;a:1:{s:5:\"title\";s:20:\"FIND BEST RENTAL CAR\";}}s:9:\"widget-id\";s:23:\"rentit_productfilters-1\";s:7:\"id_base\";s:21:\"rentit_productfilters\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:21:\"rentit Product Filter\";s:8:\"callback\";s:48:\"Corp\\Themes\\RentIt\\Widgets\\Product\\ProductFilter\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"29\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:19:\"rentit-sidebar-shop\";}', 'en', '2018-09-27 08:59:22', '2018-10-01 08:36:38'),
(36, 30, 'rentit price Filter', 'a:14:{s:25:\"widget-rentitpricefilters\";a:1:{i:1;a:4:{s:5:\"title\";s:5:\"Price\";s:6:\"button\";N;s:3:\"min\";s:1:\"1\";s:3:\"max\";s:3:\"500\";}}s:9:\"widget-id\";s:20:\"rentitpricefilters-1\";s:7:\"id_base\";s:18:\"rentitpricefilters\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:19:\"rentit price Filter\";s:8:\"callback\";s:46:\"Corp\\Themes\\RentIt\\Widgets\\Product\\PriceFilter\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"30\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:19:\"rentit-sidebar-shop\";}', 'en', '2018-09-28 09:56:25', '2018-10-01 09:13:14'),
(38, 32, 'rentit Testimonials', 'a:14:{s:25:\"widget-rentittestimonials\";a:1:{i:1;a:2:{s:5:\"title\";s:12:\"TESTIMONIALS\";s:4:\"text\";s:1826:\"<div class=\"testimonial\">\r\n                        <div class=\"media\">\r\n                            <div class=\"media-body\">\r\n                                <div class=\"testimonial-text\">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>\r\n                                <div class=\"testimonial-name\">John Doe <span class=\"testimonial-position\">Co- founder at Rent It</span></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"testimonial\">\r\n                        <div class=\"media\">\r\n                            <div class=\"media-body\">\r\n                                <div class=\"testimonial-text\">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>\r\n                                <div class=\"testimonial-name\">John Doe <span class=\"testimonial-position\">Co- founder at Rent It</span></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"testimonial\">\r\n                        <div class=\"media\">\r\n                            <div class=\"media-body\">\r\n                                <div class=\"testimonial-text\">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>\r\n                                <div class=\"testimonial-name\">John Doe <span class=\"testimonial-position\">Co- founder at Rent It</span></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\";}}s:9:\"widget-id\";s:20:\"rentittestimonials-1\";s:7:\"id_base\";s:18:\"rentittestimonials\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:19:\"rentit Testimonials\";s:8:\"callback\";s:47:\"Corp\\Themes\\RentIt\\Widgets\\Product\\Testimonials\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"32\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:19:\"rentit-sidebar-shop\";}', 'en', '2018-09-28 14:41:42', '2018-10-01 10:01:22'),
(39, 33, 'rentit Helping Center', 'a:14:{s:26:\"widget-rentithelpingcenter\";a:1:{i:1;a:6:{s:5:\"title\";s:14:\"HELPING CENTER\";s:4:\"text\";s:79:\"Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.\";s:5:\"phone\";s:17:\"+90 555 444 66 33\";s:5:\"email\";s:25:\"support@supportcenter.com\";s:6:\"button\";s:14:\"Support Center\";s:3:\"url\";s:1:\"#\";}}s:9:\"widget-id\";s:21:\"rentithelpingcenter-1\";s:7:\"id_base\";s:19:\"rentithelpingcenter\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:21:\"rentit Helping Center\";s:8:\"callback\";s:48:\"Corp\\Themes\\RentIt\\Widgets\\Product\\HelpingCenter\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"33\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:19:\"rentit-sidebar-shop\";}', 'en', '2018-09-28 14:45:34', '2018-10-01 08:47:08'),
(40, 29, 'rentit Product Filter', 'a:14:{s:28:\"widget-rentit_productfilters\";a:1:{i:1;a:1:{s:5:\"title\";s:36:\"НАЙТИ ЛУЧШУЮ АРЕНДУ\";}}s:9:\"widget-id\";s:23:\"rentit_productfilters-1\";s:7:\"id_base\";s:21:\"rentit_productfilters\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:21:\"rentit Product Filter\";s:8:\"callback\";s:48:\"Corp\\Themes\\RentIt\\Widgets\\Product\\ProductFilter\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"29\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:19:\"rentit-sidebar-shop\";}', 'ru', '2018-10-01 08:37:03', '2018-10-01 08:37:03'),
(41, 34, 'rentit Testimonials', 'a:14:{s:25:\"widget-rentittestimonials\";a:1:{i:1;a:2:{s:5:\"title\";s:12:\"TESTIMONIALS\";s:4:\"text\";s:1826:\"<div class=\"testimonial\">\r\n                        <div class=\"media\">\r\n                            <div class=\"media-body\">\r\n                                <div class=\"testimonial-text\">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>\r\n                                <div class=\"testimonial-name\">John Doe <span class=\"testimonial-position\">Co- founder at Rent It</span></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"testimonial\">\r\n                        <div class=\"media\">\r\n                            <div class=\"media-body\">\r\n                                <div class=\"testimonial-text\">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>\r\n                                <div class=\"testimonial-name\">John Doe <span class=\"testimonial-position\">Co- founder at Rent It</span></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"testimonial\">\r\n                        <div class=\"media\">\r\n                            <div class=\"media-body\">\r\n                                <div class=\"testimonial-text\">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>\r\n                                <div class=\"testimonial-name\">John Doe <span class=\"testimonial-position\">Co- founder at Rent It</span></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\";}}s:9:\"widget-id\";s:20:\"rentittestimonials-1\";s:7:\"id_base\";s:18:\"rentittestimonials\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:4:\"name\";s:19:\"rentit Testimonials\";s:8:\"callback\";s:47:\"Corp\\Themes\\RentIt\\Widgets\\Product\\Testimonials\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"34\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-single-product\";}', 'en', '2018-10-01 10:20:18', '2018-10-01 10:28:10'),
(42, 35, 'rentit Helping Center', 'a:14:{s:26:\"widget-rentithelpingcenter\";a:1:{i:2;a:6:{s:5:\"title\";s:14:\"HELPING CENTER\";s:4:\"text\";s:79:\"Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.\";s:5:\"phone\";s:17:\"+90 555 444 66 33\";s:5:\"email\";s:25:\"support@supportcenter.com\";s:6:\"button\";s:14:\"Support Center\";s:3:\"url\";s:1:\"#\";}}s:9:\"widget-id\";s:21:\"rentithelpingcenter-2\";s:7:\"id_base\";s:19:\"rentithelpingcenter\";s:4:\"name\";s:21:\"rentit Helping Center\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"2\";s:7:\"add_new\";N;s:8:\"callback\";s:48:\"Corp\\Themes\\RentIt\\Widgets\\Product\\HelpingCenter\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"35\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-single-product\";}', 'en', '2018-10-01 10:20:36', '2018-10-01 10:21:07'),
(43, 36, 'Detail Reservation', 'a:14:{s:24:\"widget-detailreservation\";a:1:{i:1;a:2:{s:5:\"title\";s:18:\"DETAIL RESERVATION\";s:4:\"text\";N;}}s:9:\"widget-id\";s:19:\"detailreservation-1\";s:7:\"id_base\";s:17:\"detailreservation\";s:4:\"name\";s:18:\"Detail Reservation\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:8:\"callback\";s:52:\"Corp\\Themes\\RentIt\\Widgets\\Product\\DetailReservation\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"36\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:21:\"rentit-single-product\";}', 'en', '2018-10-01 10:27:25', '2018-10-01 10:27:54'),
(44, 37, 'rentit search form', 'a:14:{s:20:\"widget-rentit_search\";a:1:{i:1;a:1:{s:5:\"title\";s:6:\"Search\";}}s:9:\"widget-id\";s:15:\"rentit_search-1\";s:7:\"id_base\";s:13:\"rentit_search\";s:4:\"name\";s:18:\"rentit search form\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";N;s:8:\"callback\";s:39:\"Corp\\Themes\\RentIt\\Widgets\\SearchWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"37\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";}', 'en', '2018-10-15 09:37:02', '2018-10-15 09:37:13'),
(46, 39, 'rentit Flickr Images', 'a:15:{s:21:\"widget-rentit_archive\";a:1:{i:1;a:3:{s:5:\"title\";s:13:\"flickr-images\";s:6:\"number\";s:1:\"9\";s:7:\"user_id\";s:12:\"71865026@N00\";}}s:9:\"widget-id\";s:16:\"rentit_archive-1\";s:7:\"id_base\";s:14:\"rentit_archive\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:4:\"name\";s:20:\"rentit Flickr Images\";s:8:\"callback\";s:45:\"Corp\\Themes\\RentIt\\Widgets\\FlickrImagesWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"39\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:14:\"rentit-sidebar\";s:1:\"q\";s:14:\"/admin/widgets\";}', 'en', '2018-11-13 08:40:10', '2019-01-11 17:42:52'),
(48, 41, 'rentit search form', 'a:15:{s:20:\"widget-rentit_search\";a:1:{i:1;a:1:{s:5:\"title\";N;}}s:9:\"widget-id\";s:15:\"rentit_search-1\";s:7:\"id_base\";s:13:\"rentit_search\";s:4:\"name\";s:18:\"rentit search form\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"1\";s:7:\"add_new\";s:5:\"multi\";s:8:\"callback\";s:39:\"Corp\\Themes\\RentIt\\Widgets\\SearchWidget\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";N;s:11:\"savewidgets\";N;s:7:\"sidebar\";s:18:\"rentit-single-page\";s:1:\"q\";s:14:\"/admin/widgets\";}', 'en', '2019-01-07 09:36:48', '2019-01-07 09:36:48'),
(49, 42, 'RentIt Categories', 'a:15:{s:17:\"widget-categories\";a:1:{i:2;a:1:{s:5:\"title\";s:10:\"CATEGORIES\";}}s:9:\"widget-id\";s:12:\"categories-2\";s:7:\"id_base\";s:10:\"categories\";s:4:\"name\";s:17:\"RentIt Categories\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"2\";s:7:\"add_new\";N;s:8:\"callback\";s:44:\"Corp\\Themes\\RentIt\\Widgets\\CategoriesWidgets\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"42\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:18:\"rentit-single-page\";s:1:\"q\";s:14:\"/admin/widgets\";}', 'en', '2019-01-07 09:36:58', '2019-01-07 09:37:36'),
(50, 43, 'rentit Helping Center', 'a:15:{s:26:\"widget-rentithelpingcenter\";a:1:{i:3;a:6:{s:5:\"title\";s:14:\"HELPING CENTER\";s:4:\"text\";s:79:\"Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.\";s:5:\"phone\";s:17:\"+90 555 444 66 33\";s:5:\"email\";s:25:\"support@supportcenter.com\";s:6:\"button\";s:14:\"Support Center\";s:3:\"url\";s:1:\"#\";}}s:9:\"widget-id\";s:21:\"rentithelpingcenter-3\";s:7:\"id_base\";s:19:\"rentithelpingcenter\";s:4:\"name\";s:21:\"rentit Helping Center\";s:12:\"widget-width\";s:3:\"250\";s:13:\"widget-height\";s:3:\"200\";s:13:\"widget_number\";s:1:\"2\";s:12:\"multi_number\";s:1:\"3\";s:7:\"add_new\";N;s:8:\"callback\";s:48:\"Corp\\Themes\\RentIt\\Widgets\\Product\\HelpingCenter\";s:6:\"action\";s:11:\"save-widget\";s:8:\"saved_id\";s:2:\"43\";s:11:\"savewidgets\";N;s:7:\"sidebar\";s:18:\"rentit-single-page\";s:1:\"q\";s:14:\"/admin/widgets\";}', 'en', '2019-01-07 09:37:07', '2019-01-07 09:45:12');




CREATE TABLE IF NOT EXISTS `locations_menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `locations` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locations_menus_menu_id_foreign` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

REPLACE INTO `locations_menus` (`id`, `locations`, `menu_id`, `created_at`, `updated_at`) VALUES
(32, 'header-menu', 1, '2019-01-16 08:24:14', '2019-01-16 08:24:14');

