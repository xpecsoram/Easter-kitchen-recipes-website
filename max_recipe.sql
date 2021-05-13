-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2021 at 10:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `max_recipe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `password` varchar(45) NOT NULL,
  `phone` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `date_of_birth`, `gender`, `password`, `phone`) VALUES
(1, 'Maxim Pecsora', 'mxpcsr', 'mxpcsrgmail.com', '2000-10-25', 'Male', '12345', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `image`) VALUES
(1, 'Lunch', 'lunch.jpg'),
(2, 'Dinner', 'dinner.jpg'),
(3, 'Quick & easy', 'quick-easy.jpg'),
(4, 'Healthy', 'healthy.jpg'),
(5, 'Gluten free', 'gluten-free.jpg'),
(6, 'Vegetarian', 'vegetarian.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `user_id`, `recipe_id`) VALUES
(1, 1, 1),
(7, 1, 5),
(8, 1, 12),
(11, 1, 10),
(13, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `category_id` int(11) NOT NULL,
  `ingredients` text NOT NULL,
  `instructions` text NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `category_id`, `ingredients`, `instructions`, `image`) VALUES
(1, 'Miso-Butter Roast Chicken With Acorn Squash Panzanella', 3, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'apples-and-oranges-spiked-cider.jpg'),
(5, 'Salty Miso-Squash Ramen', 2, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'butternut-squash-apple-soup-365210.jpg'),
(6, 'Crispy Salt and Pepper Potatoes', 4, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'caesar-salad-roast-chicken.jpg'),
(7, 'Thanks giving Mac and Cheese', 5, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'caramelized-plantain-parfait.jpg'),
(8, 'Italian Sausage and Bread Stuffing', 6, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'chhena-poda-paneer-cheesecake.jpg'),
(9, 'Apples and Oranges', 1, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'chicken-and-potato-gratin-brown-butter-cream.jpg'),
(10, 'Turmeric Hot Toddy', 2, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'chicken-and-rice-with-leeks-and-salsa-verde.jpg'),
(11, 'Instant Pot Lamb Haleem with Salt', 3, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'crispy-salt-and-pepper-potatoes-dan-kluger.jpg'),
(12, 'Spiced Lentil and Caramelized Onion Baked Eggs', 4, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'enfrijoladas.jpg'),
(13, 'Hot Pimento Cheese Dip', 5, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'gorditas-con-camarones.jpg'),
(14, 'Spiral Ham in the Slow Cooker', 6, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'homemade-paneer-recipe.jpg'),
(15, 'Butternut Squash and Apple Soup', 1, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'hot-pimento-cheese-dip-polina-chesnakova.jpg'),
(16, 'Caesar Salad Roast Chicken', 2, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'instant-pot-lamb-haleem.jpg'),
(17, 'Chicken and Rice With Leeks and Salsa Verde', 3, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'italian-sausage-and-bread-stuffing-240559.jpg'),
(18, 'Gorditas con Camarones', 5, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'kale-and-pumpkin-falafels-with-pickled-carrot-slaw.jpg'),
(19, 'Caramelized Plantain Parfait', 6, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'maple-chile-roasted-pumpkin-with-quinoa-tabouli.jpg'),
(20, 'Chicken and Potato Gratin With Brown Butter Cream', 1, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'miso-butter-roast-chicken-acorn-squash-panzanella.jpg'),
(21, 'Roasted Beets With Crispy Sunchokes and Pickled Orange-Ginger Purée', 2, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'miso-squash-ramen-hetty-mckinnon.jpg'),
(22, 'Kale and Pumpkin Falafels With Pickled Carrot Slaw', 3, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'newtons-law-apple-bourbon-cocktail.jpg'),
(23, 'Maple and Chile Roasted Squash With Quinoa Tabouli', 4, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'r-rated-caramelized-onions-vivian-howard.jpg'),
(24, 'Chhena Poda (Spiced Cheesecake)', 5, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'roasted-beets-with-crispy-sunchokes-and-pickled-orange-ginger-puree.jpg'),
(25, 'Paneer', 6, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'sloppy-joe-shirred-eggs-with-spinach-vivian-howard.jpg'),
(26, 'Sloppy Joe Shirred Eggs With Spinach', 1, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'spiced-lentil-and-caramelized-onion-baked-eggs.jpg'),
(27, 'Spicy Coconut Pumpkin Soup', 3, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'spiral-ham-in-the-slow-cooker-guarnaschelli.jpg'),
(28, 'Trinidad Curry Powder', 4, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'thanksgiving-mac-and-cheese-erick-williams.jpg'),
(29, 'Green Seasoning', 5, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'turmeric-hot-toddy-claire-sprouse.jpg'),
(30, 'Our Favorite Creamy Mashed Potatoes', 6, '- 1 (3½–4-lb.) whole chicken<br> - 2¾ tsp. kosher salt, divided, plus more<br> - 2 small acorn squash (about 3 lb. total)<br> - 2 Tbsp. finely chopped sage<br> - 1 Tbsp. finely chopped rosemary<br> - 6 Tbsp. unsalted butter, melted, plus 3 Tbsp. room temperature<br> - ¼ tsp. ground allspice<br> - Pinch of crushed red pepper flakes<br> - Freshly ground black pepper<br> - ⅓ loaf good-quality sturdy white bread, torn into 1\" pieces (about 2½ cups)<br> - 2 medium apples (such as Gala or Pink Lady; about 14 oz. total), cored, cut into 1\" pieces<br> - 2 Tbsp. extra-virgin olive oil<br> - ½ small red onion, thinly sliced<br> - 3 Tbsp. apple cider vinegar<br> - 1 Tbsp. white miso<br> - ¼ cup all-purpose flour<br> - 2 Tbsp. unsalted butter, room temperature<br> - ¼ cup dry white wine<br> - 2 cups unsalted chicken broth<br> - 2 tsp. white miso<br> - Kosher salt, freshly ground pepper', 'Preheat oven to 400°F and line a rimmed baking sheet with parchment. In a large bowl, whisk the egg whites until foamy (there shouldn’t be any liquid whites in the bowl). Add the potatoes and toss until they’re well coated with the egg whites, then transfer to a strainer or colander and let the excess whites drain. Season the potatoes with the salt, pepper, and herbs. Scatter the potatoes on the baking sheet (make sure they’re not touching) and roast until the potatoes are very crispy and tender when poked with a knife, 15 to 20 minutes (depending on the size of the potatoes). Transfer to a bowl and serve.', 'warm-comfort-tequila-chamomile-toddy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `comment` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `recipe_id`, `stars`, `comment`) VALUES
(1, 4, 5, 4, 'I had lunch with some of my colleagues at Echo on Day 1. I had the wedge salad - it was delicious. On Night 2, I enjoyed a drink at the bar. I had a Margarita. The service was excellent.'),
(2, 4, 5, 5, 'The food was fresh, properly prepared and a great value for the price. We highly recommend it. The breakfast buffet on Sunday was equally as good.'),
(4, 1, 5, 5, 'The food was fresh, properly prepared and a great value for the price. We highly recommend it. The breakfast buffet on Sunday was equally as good.'),
(5, 1, 6, 4, 'I had lunch with some of my colleagues at Echo on Day 1. I had the wedge salad - it was delicious. On Night 2, I enjoyed a drink at the bar. I had a Margarita. The service was excellent.'),
(6, 5, 1, 4, 'some comment'),
(7, 1, 7, 5, 'this is a comment');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `date_of_birth`, `gender`, `phone`) VALUES
(1, 'Maxim Pecsora', 'mxpcsr', 'mxpcsr@gmail.com', '12345', '2000-10-25', 'Male', 1234567),
(2, 'John Doe', 'john', 'john.doe@gmail.com', '12345', '1993-07-09', 'Male', 9876543),
(4, 'Sarah Doe', 'sarah', 'dd@dd.com', '12345', '2021-05-05', 'Female', 1234567),
(5, 'test', 'test', 'test@test.com', '12345', '2021-05-06', 'Male', 4569876);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2006;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
