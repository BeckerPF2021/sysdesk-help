-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Maio-2025 às 22:13
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sysdesk_help`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'EQUIPAMENTOS', '2025-05-09 20:07:17', '2025-05-09 20:07:17'),
(2, 'E-MAIL', '2025-05-20 19:04:45', '2025-05-20 19:04:45'),
(3, 'BANCO DE DADOS', '2025-05-20 19:04:53', '2025-05-20 19:04:53'),
(4, 'SISTEMAS WEB', '2025-05-20 19:05:04', '2025-05-20 19:05:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'RH', '2025-05-09 20:07:07', '2025-05-09 20:07:07'),
(2, 'LOGISTICA', '2025-05-20 18:51:13', '2025-05-20 18:51:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `interaction_types`
--

CREATE TABLE `interaction_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_users_table', 1),
(3, '0001_01_01_000003_create_jobs_table', 1),
(4, '2025_05_05_213417_create_departments', 1),
(5, '2025_05_05_213436_create_categories', 1),
(6, '2025_05_05_213450_create_ticket_statuses', 1),
(7, '2025_05_05_213510_create_ticket_priorities', 1),
(8, '2025_05_05_213511_create_interaction_types', 1),
(9, '2025_05_05_213640_create_tickets', 1),
(10, '2025_05_05_213821_create_ticket_interactions', 1),
(11, '2025_05_05_213838_create_ticket_histories', 1),
(12, '2025_05_05_213852_create_notifications', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('email','popup') NOT NULL,
  `status` enum('pending','sent','error') NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_ticket_interaction_id` bigint(20) UNSIGNED NOT NULL,
  `fk_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gVaI0ZyayKoWYzG8uIbp5ypQY43etJf9u6rw2cWT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWNRWUh1SEVPUGpsUmZpOW95eENmeU14Qk5FdWszeGNoeEJmOU5odCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90aWNrZXQtc3RhdHVzZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747760322);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fk_user_id` bigint(20) UNSIGNED NOT NULL,
  `fk_responsible_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fk_category_id` bigint(20) UNSIGNED NOT NULL,
  `fk_ticket_priority_id` bigint(20) UNSIGNED NOT NULL,
  `fk_ticket_status_id` bigint(20) UNSIGNED NOT NULL,
  `fk_department_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `created_at`, `updated_at`, `fk_user_id`, `fk_responsible_user_id`, `fk_category_id`, `fk_ticket_priority_id`, `fk_ticket_status_id`, `fk_department_id`) VALUES
(1, 'Teclado', 'Trocar Teclado', '2025-05-09 20:08:36', '2025-05-09 20:08:36', 1, NULL, 1, 1, 1, 1),
(2, 'Mouse', 'Mouse com problema', '2025-05-20 19:02:50', '2025-05-20 19:04:33', 1, NULL, 1, 4, 4, 2),
(3, 'SISTEMAS WEB', 'SISTEMA WEB COM PROBLEMA', '2025-05-20 19:05:40', '2025-05-20 19:05:40', 1, NULL, 4, 4, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_histories`
--

CREATE TABLE `ticket_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `action` text NOT NULL,
  `fk_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `fk_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_interactions`
--

CREATE TABLE `ticket_interactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `interaction_type` bigint(20) UNSIGNED NOT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `fk_user_id` bigint(20) UNSIGNED NOT NULL,
  `fk_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_priorities`
--

CREATE TABLE `ticket_priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ticket_priorities`
--

INSERT INTO `ticket_priorities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'BAIXA', '2025-05-09 20:08:13', '2025-05-09 20:08:13'),
(2, 'MEDIA', '2025-05-20 19:04:06', '2025-05-20 19:04:06'),
(3, 'ALTA', '2025-05-20 19:04:11', '2025-05-20 19:04:11'),
(4, 'URGENTE', '2025-05-20 19:04:15', '2025-05-20 19:04:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_statuses`
--

CREATE TABLE `ticket_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `ticket_statuses`
--

INSERT INTO `ticket_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'FECHADO', '2025-05-09 20:07:29', '2025-05-20 19:01:48'),
(2, 'ABERTO', '2025-05-09 20:08:02', '2025-05-09 20:08:02'),
(3, 'RESOLVIDO', '2025-05-20 19:01:55', '2025-05-20 19:01:55'),
(4, 'EM ATENDIMENTO', '2025-05-20 19:02:03', '2025-05-20 19:02:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_group_id`, `created_at`, `updated_at`) VALUES
(1, 'Guilherme P. Becker', '194749@upf.br', NULL, '$2y$12$amSZ3I7K5/3ifMemNEesLOvZ000LtjlLPoQigACk6CaNHClJFJVk.', NULL, 1, '2025-05-09 20:06:35', '2025-05-20 19:36:50'),
(2, 'admin', 'admin@upf.br', NULL, '$2y$12$hlLfG35Q6O.cJGlO7fE8f.HrWE1/QCv56gcbKRiglpoJQkHCrqcZy', NULL, 2, '2025-05-20 18:50:14', '2025-05-20 18:50:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Administrador', '2025-05-09 20:06:51', '2025-05-09 20:06:51'),
(2, 'Usuario', 'Grupo de Usuários Padrão', '2025-05-20 18:50:50', '2025-05-20 18:50:50');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Índices para tabela `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `interaction_types`
--
ALTER TABLE `interaction_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `interaction_types_name_unique` (`name`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_fk_ticket_interaction_id_foreign` (`fk_ticket_interaction_id`),
  ADD KEY `notifications_fk_ticket_id_foreign` (`fk_ticket_id`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_fk_user_id_foreign` (`fk_user_id`),
  ADD KEY `tickets_fk_category_id_foreign` (`fk_category_id`),
  ADD KEY `tickets_fk_ticket_priority_id_foreign` (`fk_ticket_priority_id`),
  ADD KEY `tickets_fk_ticket_status_id_foreign` (`fk_ticket_status_id`),
  ADD KEY `tickets_fk_department_id_foreign` (`fk_department_id`),
  ADD KEY `fk_tickets_responsible_user` (`fk_responsible_user_id`);

--
-- Índices para tabela `ticket_histories`
--
ALTER TABLE `ticket_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_histories_fk_ticket_id_foreign` (`fk_ticket_id`),
  ADD KEY `ticket_histories_fk_user_id_foreign` (`fk_user_id`);

--
-- Índices para tabela `ticket_interactions`
--
ALTER TABLE `ticket_interactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_interactions_fk_user_id_foreign` (`fk_user_id`),
  ADD KEY `ticket_interactions_fk_ticket_id_foreign` (`fk_ticket_id`);

--
-- Índices para tabela `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_priorities_name_unique` (`name`);

--
-- Índices para tabela `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_statuses_name_unique` (`name`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_group_id_foreign` (`user_group_id`);

--
-- Índices para tabela `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_groups_name_unique` (`name`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `interaction_types`
--
ALTER TABLE `interaction_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `ticket_histories`
--
ALTER TABLE `ticket_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ticket_interactions`
--
ALTER TABLE `ticket_interactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_fk_ticket_id_foreign` FOREIGN KEY (`fk_ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_fk_ticket_interaction_id_foreign` FOREIGN KEY (`fk_ticket_interaction_id`) REFERENCES `ticket_interactions` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_responsible_user` FOREIGN KEY (`fk_responsible_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_fk_category_id_foreign` FOREIGN KEY (`fk_category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `tickets_fk_department_id_foreign` FOREIGN KEY (`fk_department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_fk_ticket_priority_id_foreign` FOREIGN KEY (`fk_ticket_priority_id`) REFERENCES `ticket_priorities` (`id`),
  ADD CONSTRAINT `tickets_fk_ticket_status_id_foreign` FOREIGN KEY (`fk_ticket_status_id`) REFERENCES `ticket_statuses` (`id`),
  ADD CONSTRAINT `tickets_fk_user_id_foreign` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `ticket_histories`
--
ALTER TABLE `ticket_histories`
  ADD CONSTRAINT `ticket_histories_fk_ticket_id_foreign` FOREIGN KEY (`fk_ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_histories_fk_user_id_foreign` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `ticket_interactions`
--
ALTER TABLE `ticket_interactions`
  ADD CONSTRAINT `ticket_interactions_fk_ticket_id_foreign` FOREIGN KEY (`fk_ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_interactions_fk_user_id_foreign` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
