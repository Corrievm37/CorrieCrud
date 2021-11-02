
CREATE TABLE `system_people` (
                                 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `idnr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `cellnr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `birthdate` date NOT NULL,
                                 `language` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `interest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT current_timestamp(),
                                 `updated_at` timestamp NULL DEFAULT current_timestamp(),
                                 PRIMARY KEY (`id`),
                                 UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


CREATE TABLE `users` (
                                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                    `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                    `email_verified_at` timestamp NULL DEFAULT NULL,
                                    `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                    `two_factor_secret` text COLLATE utf8_unicode_ci DEFAULT NULL,
                                    `two_factor_recovery_codes` text COLLATE utf8_unicode_ci DEFAULT NULL,
                                    `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
                                    `current_team_id` bigint(20) unsigned DEFAULT NULL,
                                    `profile_photo_path` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    UNIQUE KEY `users_email_unique` (`email`)
         ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;