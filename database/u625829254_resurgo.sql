-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2024 at 07:43 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u625829254_resurgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'resurgo_admin', '$2y$10$S1PDw1F6kq7YS2Xieffk6Orq3IJeVAZDbG56n4j/dTrX3aA8/C1UC', 'Cecile', 'Daza', 'dp112.jpg', '2018-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `applicant_id` varchar(10) DEFAULT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `street_address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state_province` varchar(200) NOT NULL,
  `postal_zip_code` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_info` varchar(30) NOT NULL,
  `position_id` int(30) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `process_id` int(3) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `applicant_id`, `firstname`, `middlename`, `lastname`, `gender`, `street_address`, `city`, `state_province`, `postal_zip_code`, `birthdate`, `email`, `contact_info`, `position_id`, `resume`, `process_id`, `status`) VALUES
(4, '79-0090', 'Miguel', 'Moreno', 'Macapagal', 'Male', 'Zone 7, Bantug', 'Guimba', 'Nueva Ecija', '3115', '2001-01-11', 'carl09450059036@gmail.com', '09979236679', 1, 'sample.pdf', 0, 0),
(35, '65-8771', 'Carl John', 'Q', 'Yasays', 'Male', 'dasd', 'asd', 'asd', '', '2006-05-10', 'carl09450059036@gmail.com', '3123', 1, 'Philippine-Civil-Service-Exam-Complete-Practice-Test-v1.7-from-CSEREVIEWER.COM.pdf', 0, 1),
(40, '34-8246', 'Mharco Angelo ', 'Alpindo', 'Vista', 'Male', 'Purok 3 Lennec', 'Guimba', 'Nueva Ecija', '3115', '2006-05-02', 'mharcoangelov@gmail.com', '09278125228', 1, 'Resume chuchubels.pdf', 3, 0),
(53, '30-8335', 'Carl John Daniel', 'Quibuyen', 'Yasay', 'Male', 'Zone 7, Macatcatuit', 'Guimba', 'Nueva Ecija', '3115', '2006-05-16', 'carl09450059036@gmail.com', '09450059036', 1, 'VILLANUEVA-WK004-Case-Analysis-1.pdf', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(10) DEFAULT NULL,
  `date` date NOT NULL,
  `time_in_AM` time NOT NULL,
  `time_in_AM_status` int(1) NOT NULL,
  `time_out_AM` time NOT NULL,
  `time_out_AM_status` int(1) NOT NULL,
  `time_in_PM` time NOT NULL,
  `time_in_PM_status` int(1) NOT NULL,
  `time_out_PM` time NOT NULL,
  `time_out_PM_status` int(1) NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in_AM`, `time_in_AM_status`, `time_out_AM`, `time_out_AM_status`, `time_in_PM`, `time_in_PM_status`, `time_out_PM`, `time_out_PM_status`, `num_hr`) VALUES
(1, '51-04964', '2024-05-05', '07:00:00', 1, '12:00:00', 0, '13:00:00', 1, '16:00:00', 0, 9),
(4, '51-04964', '2024-04-28', '07:00:00', 1, '12:30:00', 1, '13:00:00', 1, '17:00:00', 0, 9.5),
(31, '61-03893', '2024-05-06', '07:00:00', 1, '12:15:00', 1, '13:00:00', 1, '18:00:00', 1, 10.25),
(32, '51-04964', '2024-05-04', '13:00:00', 0, '13:00:00', 1, '13:00:00', 1, '13:00:00', 0, 2),
(33, '23-22689', '2024-05-17', '08:27:43', 0, '08:27:51', 0, '08:28:04', 0, '08:28:15', 0, 0),
(46, '87-55483', '2024-05-25', '09:06:10', 0, '11:49:09', 0, '12:10:31', 0, '00:00:00', 0, 13.516666666667),
(61, '67-14044', '2024-05-25', '11:39:54', 0, '11:46:26', 0, '00:00:00', 0, '00:00:00', 0, 10.866666666667),
(62, '67-10184', '2024-05-25', '00:00:00', 0, '12:55:32', 1, '12:55:11', 1, '00:00:00', 0, 18.416666666667);

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `queries` text NOT NULL,
  `replies` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `queries`, `replies`) VALUES
(1, 'hi|hey|hy|hello', 'Hi there!'),
(2, 'what is OLSHCO|what is OLSHCO?|where is olshco located?|where is olshco located|where is olshco|where is olshco?|where is olshco|where is olshco?|OLSHCO|OLSHCO?', 'Our Lady of the Sacred Heart College (OLSHCO) of Guimba, Inc. is a private, Catholic school in the municipality of Guimba, Nueva Ecija. It was founded by a Dutch missionary in 1947; and, in its first few years it provided basic education programs. It was initially administered by the  Missionaries of the Sacred Heart (MSC). The Franciscan Sisters of the Immaculate Conception of the Holy Mother of God (SFIC) helped manage the school in 1948. Currently, Franciscan sisters and the lay share the administration.'),
(3, 'what academic programs does olshco offer?|program?|academic programs|academic', 'The college offers four-year undergraduate courses in Elementary Education, Secondary Education, Hospitality Management, Office Administration, and Information Technology. It also offers a Teacher Certificate Program (TCP) and an Associate program in Computer Technology (ACT). The school is also a K-12 accredited institution, with a Senior High School (SHS) department providing various strands from the Academic and the Technical-Vocational-Livelihood (TVL) tracks.'),
(4, 'does olshco provide job opportunities?|job opportunities|what types of jobs does OLSHCO offer?|can I find a job at OLSHCO?|job|career|career opportunities', 'OLSHCO offers a diverse range of job opportunities across multiple sectors, including teaching, administration, and support staff roles. These positions are often advertised on the career portal. Prospective candidates can expect openings in various departments, spanning from educational roles to administrative and operational positions. Those interested in pursuing employment at OLSHCO are encouraged to regularly check the institutions career page for updates on job postings and application procedures. With a commitment to fostering a dynamic work environment, OLSHCO presents individuals with the chance to contribute to its educational mission and community initiatives through fulfilling career paths.'),
(5, 'what is resurgo?|resurgo|resurgo|can I find a job at olshco?|What does resurgo do?|Why is resurgo important?|What services does resurgo provide?', 'Resurgo serves as the Human Resources Management division of OLSHCO, focusing on a wide array of HR-related tasks essential for the institutions smooth operation. Its primary responsibilities include recruitment, employee and application management, payroll and payslip management, as well as attendance and leave management. Additionally, Resurgo oversees the posting of vacancies within the organization, ensuring that staffing needs are effectively addressed. Through its comprehensive management of human resources, Resurgo plays a vital role in supporting the institutions workforce and facilitating efficient HR operations.'),
(6, 'who are the developers of resurgo?|can you provide more details about the developers of resurgo?|how many developers are involved in resurgo?', 'The developers of Resurgo are a group of individuals led by Carl John Yasay. Alongside him, there are John Vincent Prado, Jhon Henrick Lucas, Mharco Vista, Jayson Paderan, and John Wendell Rivera. These developers are all students of OLSHCO, each contributing their skills and expertise to the project. They handle various aspects of Resurgo, including its design, development, and maintenance. Their primary goal is to create and manage a comprehensive Human Resources Management system tailored to the needs of OLSHCO, encompassing tasks such as recruitment, employee and application management, payroll and payslip management, attendance and leave management, and vacancy posting.'),
(7, 'saan matatagpuan ang OLSHCO?|saan ang olshco?|saan ang OLSHCO?', 'Ang Our Lady of the Sacred Heart College (OLSHCO) ng Guimba, Inc. ay isang pribadong, Katolikong paaralan sa bayan ng Guimba, Nueva Ecija. Ito ay itinatag ng isang misyonaryong Dutch noong 1947; at sa unang ilang taon nito ay nagbibigay ng mga programa sa basic na edukasyon. Unang binabantayan ito ng Missionaries of the Sacred Heart (MSC). Ang mga Franciscan Sisters of the Immaculate Conception of the Holy Mother of God (SFIC) ay tumulong sa pagpapatakbo ng paaralan noong 1948. Sa kasalukuyan, ang mga madre Franciscan at ang mga lay share ay nagbabahagi sa administrasyon.'),
(8, 'ano ang mga programa na inaalok ng olshco?|inaalok|programa|inaalok?|programa?|inaalok ng olshco?|inaalok ng olshco|inaalok ng OLSHCO?|inaalok ng OLSHCO', 'Ang OLSHCO ay nag-aalok ng iba`t ibang mga programa sa edukasyon mula elementarya hanggang kolehiyo. Kasama sa kanilang mga programa ang K to 12 curriculum para sa elementarya at hayskul, kolehiyo na may iba`t ibang mga kurso tulad ng Bachelor of Science in Accountancy, Bachelor of Science in Business Administration, at iba pa. Mayroon din silang mga non-degree program tulad ng computer literacy training at iba pang vocational courses.'),
(9, 'what are the admission requirements for olshco?|ano ang mga kinakailangang requirements para sa pagpasok sa olshco?', 'Ang mga kinakailangang requirements para sa pagpasok sa OLSHCO ay maaaring mag-iba depende sa antas ng edukasyon. Para sa elementarya at hayskul, karaniwang kinakailangan ang birth certificate, report card mula sa huling paaralan, at iba pang mga dokumento ng pagkakakilanlan. Para sa kolehiyo, karaniwang kinakailangan ang high school diploma o katulad na kwalipikasyon, mga pagsusulit tulad ng entrance exam, at iba pang mga dokumento ayon sa iniaalok na kurso.'),
(10, 'what is the contact information of olshco?|ano ang contact information ng olshco?', 'Maaring makipag-ugnayan sa Our Lady of the Sacred Heart College (OLSHCO) ng Guimba, Inc. sa sumusunod na mga pamamaraan: Address: Brgy. Poblacion, Guimba, Nueva Ecija, Philippines. Telephone: (+63)44-611-2448. Email: [email protected]'),
(11, 'who founded olshco?|sino ang nagtatag ng olshco?', 'Ang Our Lady of the Sacred Heart College (OLSHCO) ng Guimba, Inc. ay itinatag ng isang misyonaryong Dutch noong 1947.'),
(12, 'what is the history of olshco?|ano ang kasaysayan ng olshco?', 'Ang OLSHCO ay itinatag noong 1947 ng isang misyonaryong Dutch. Sa unang mga taon nito, nagbibigay ito ng mga basic na edukasyon. Unang pinamamahalaan ito ng Missionaries of the Sacred Heart (MSC), at pinalitan ng Franciscan Sisters of the Immaculate Conception of the Holy Mother of God (SFIC) noong 1948. Sa kasalukuyan, ang administrasyon ng paaralan ay hinahati ng mga madre Franciscan at lay share.'),
(13, 'what facilities does olshco have?|ano ang mga pasilidad na mayroon ang olshco?', 'Ang OLSHCO ay mayroong iba`t ibang mga pasilidad para sa mga mag-aaral at guro. Kasama sa mga ito ang mga silid-aralan, laboratories, computer rooms, library, sports facilities tulad ng basketball court at volleyball court, at iba pang mga pasilidad para sa extracurricular activities.'),
(14, 'what are the tuition fees at olshco?|magkano ang tuition fee sa olshco?', 'Ang tuition fee sa OLSHCO ay maaaring mag-iba depende sa antas ng edukasyon at programa na pinili ng mag-aaral. Karaniwang may iba`t ibang mga singil para sa elementarya, hayskul, at kolehiyo. Maaaring makipag-ugnayan sa paaralan mismo para sa eksaktong impormasyon tungkol sa mga bayarin.'),
(15, 'what extracurricular activities does olshco offer?|ano ang mga extracurricular activities na inaalok ng olshco?', 'Ang OLSHCO ay nag-aalok ng iba`t ibang mga extracurricular activities para sa mga mag-aaral upang mapalawak ang kanilang kasanayan at interes. Kasama sa mga ito ang sports clubs tulad ng basketball at volleyball, academic clubs tulad ng math club at science club, at cultural clubs tulad ng choir at dance troupe.');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `deduction` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `deduction`, `amount`) VALUES
(1, 'SSS', 100),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 150),
(4, 'Project Issues', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `hire_date` date NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `middlename`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `email`, `position_id`, `schedule_id`, `photo`, `hire_date`, `username`, `password`, `status`) VALUES
(1, '51-04964', 'Carl John', 'Quibuyen', 'Yasay', 'Macatcatuit, Guimba, N.E', '2001-04-02', '09000035719', 'Male', 'carl09450059036@gmail.com', 1, 5, 'dp.jpg', '2018-04-28', '21P93E7B', '$2y$10$E/7Atd/9GgORta5nIRAKLOd7wBYPcXZ15MOlMe0rS4.i83g//anma', 0),
(200, '61-03893', 'Carl John', 'Quibuyen', 'Yasay', 'Zone 7, Macatcatuit Guimba Nueva Ecija 3115', '2003-01-21', '09979236679', 'Male', 'carl09450059036@gmail.com', 1, 5, 'dp112.jpg', '2024-05-06', '5dRuYdTR', '$2y$10$jAMG8jIOdIEWVjX0S/TPMe3/mGbEpbEs3wO14eWjDOAc58qfj10YK', 0),
(201, '38-59709', 'eldrinnn', 'l', 'libunaooo', 'triala guimba nueva ecija 3115', '2003-03-15', '09651826253', 'Male', 'libunaoeldrin1@gmail.com', 1, 0, '', '2024-05-10', 'csbp2xV9', '$2y$10$/WonHaQyGDTNZIwKaqo5Bu86XJY45mCB4tGYecRYWyoiMwCPrD5mu', 0),
(202, '55-11918', 'Zcyrene Dhale Marquin ', 'Pulanco', 'Pujeda', 'Manacsac, Secret,  Guimba Nueva Ecija 3115', '2001-02-17', '09090909090', 'Male', 'zcydhamarq@gmai.com', 1, 0, '', '2024-05-10', 'yDd7pRkZ', '$2y$10$5W5P9wS6a2WemjU/JeNSwuKokMrDHXw.fSRB./nFGDVKiElfIC7e6', 0),
(203, '66-62882', 'Jennifer ', 'Reyes', 'Domingo', 'Dyan lang Di pa city yung Guimba Yung province bakit di capital yung first letter 3115', '1999-10-20', '41234253464', 'Female', 'jnnfrjydmng@gmail.com', 1, 0, '', '2024-05-10', 'xIF8dY8D', '$2y$10$C4r7PSU8CZymYD1qqQgX9uUA.QJ5TxJU04PRa496VRpjhzgQU8JLC', 0),
(204, '24-50234', 'carl jeferson', 'octoman', 'rallos', 'macatcatuit guimba nueva ecija 3115', '2002-01-18', '09158830440', 'Male', 'carl@gmail.com', 1, 0, '', '2024-05-10', 'bizO8hFW', '$2y$10$8vIOigIt/T7LeBitRGqbc.7t18TvVCwjr2cgbOPal7UnB7/AgtKw6', 0),
(205, '87-41587', 'Katrina', 'Tolentino', 'Obena', 'kimi rut rut 3115', '2003-03-04', '09829372184', 'Female', 'katrinaobena4@gmail.com', 1, 0, '', '2024-05-10', 'JjwcqwSM', '$2y$10$FI3FdhMrIPrjPAkGv2lwb.lXSVoF5HKsRkNQjawg7RGBvWmoptLCq', 0),
(206, '14-48019', 'leonardo', 'panerio', 'pornuevo', 'triala KALAMARES BAYAN 3115', '2002-09-18', '09765678675', 'Male', 'alle12@gmail.com', 1, 0, '', '2024-05-10', 'LPdgR6sP', '$2y$10$S5D4TvjKtI5FMVInuvSBluqlw6b212tUR.uDharNUW6Wbi90QrH9.', 0),
(207, '32-36055', 'Hannah', '', 'Reyes', 'Sta.Veronica Guimba Nueva Ecija 3115', '1999-10-26', '09602033667', 'Female', 'reyeshannahjoy82@gmail.com', 1, 0, 'file-teaching-skills-1605625101.jpg', '2024-05-10', 'sA5rXC4x', '$2y$10$Y/U421k1FEwY9bfwSgUIVORXQnlA.VwlnAMttKTm1Dkeahu9HjSr.', 0),
(208, '86-77307', 'KALAMARES', 'KARANER', 'SUMAKAS', 'trialats KALAMARES BAYAN 3115', '2002-01-22', '09765678675', 'Male', 'pornuevoleonardo2626@gmail.com', 1, 0, '', '2024-05-10', '3rQ2gPKk', '$2y$10$WdCYx7.QLTYrJVAJ2Rmsdu7U48Sv//HuySFLCAZPipLv3BrUnh34e', 0),
(209, '44-12435', 'Frankyyy', 'F', 'Molina', 'Yuson eme  Guimba 15', '1941-02-15', '09876543219', 'Male', 'molinafrancess7@gmail.com', 1, 0, '', '2024-05-10', '9ERIEm0c', '$2y$10$yU6pCkzN9F6SvwdzjrSMB.dS82WA.rGOFKcDFO7oXhIRKfZolHM62', 0),
(210, '55-51991', 'Ako to si JIem', '', 'd', 'da12 dad dadasd 3124124', '1939-05-10', '342', 'Male', 'jiemjiem53@gmail.com', 1, 0, 'message (6).txt', '2024-05-10', 'VAA3hHGl', '$2y$10$tGmn6PogNcBgSiWq9iwRRuqGJ2MU/otbFh1/6O1GVnvdQKXlTKzrq', 0),
(211, '37-87681', 'Jm Ordonio', 'Toledo', 'Ordonio', 'Narvacan 2 Guimba Nueva Ecija 3115', '2002-09-09', '09274139402', 'Male', 'ordonioj139@gmail.com', 1, 0, '', '2024-05-10', 'pEFpVVbf', '$2y$10$7W4PbDc00btNQQc79QBGGeV.o1RfJqG1V7/dvbTaIltbRxl1kvtHe', 0),
(212, '37-24212', 'Kristine', 'Gacutan', 'Villano', 'Yuson Guimba, Nueva, Ecija Guimba Nueva Ecija 3115', '2002-12-10', '09876543212', 'Female', 'kristinejoyvillano10@gmail.com', 1, 0, '', '2024-05-10', 'CqP7UGVf', '$2y$10$P3v3X04FAC2IlsToPy/bqegSLZhjqS6/6zquk/xBsz6ODEdju8xxe', 0),
(213, '24-74591', 'Lyka', 'Bernardino', 'Refugia', 'Sta.Veronica Guimba Nueva Ecija 3115', '2002-02-11', '09602033667', 'Female', 'lebronrefugia@gmail.com', 1, 0, 'file-teaching-skills-1605625101.jpg', '2024-05-10', 'FfDlUp5G', '$2y$10$Uby/AXe5Y2R7chfxzGXUXuD4yxyXgQNVHX7H7VmxddyiI69jPFhZu', 0),
(214, '75-99052', 'Angelo', 'Alfonso', 'Libunao', 'Purok 3, Triala Guimba Nueva Ecija 3115', '2003-02-20', '09547325275', 'Male', 'angelolibunao02202000@gmail.com', 1, 0, '', '2024-05-10', 'tI1SONXD', '$2y$10$SQ7n1x/q94DsTq7jeYkQquk05j35yJJ7vZt8bOBskZpMzF34bRTAW', 0),
(215, '68-72933', 'Charmaine Joyce', 'Baldo', 'Coloma', 'Maturanoc Guimba Nueva Ecija 3115', '1999-11-20', '09763414271', 'Female', 'charmainecoloma02@gmail.com', 1, 0, 'CHAPTER-3.docx', '2024-05-10', '6hVSWXWb', '$2y$10$dOWuAWCybIwwwlrdc/zK9ODsDJSCM2tD5JmjqoZUrT7MM3hSzOQta', 0),
(216, '76-13543', 'carl', 'octoman', 'rallos', 'macatcatuit guimba nueva ecija 3115', '2002-01-18', '09696969696', 'Male', 'ralloscarljeff@gmail.com', 1, 0, '', '2024-05-10', 'vLAGfAKq', '$2y$10$bfXtjzrptSVcGfg2BmBXoOuSM7fyuarkqZhWawTIgtXxN3FCV9gue', 0),
(217, '34-97196', 'carl', 'octoman', 'rallos', 'macatcatuit guimba nueva ecija 3115', '2002-01-18', '09696969696', 'Male', 'ralloscarljeff@gmail.com', 1, 0, '', '2024-05-10', 'eqOMid82', '$2y$10$Xh7c295RcgGLvisnfmteFek.vizNRzfoYh7HrOXajvsyaPlKr.wIa', 0),
(218, '89-60394', 'jayvee', 'tayong', 'mangalino', 'pasong inchic guimba nueva ecija 3115', '1996-05-08', '09464092423', 'Male', 'jayveemangalino9@gmail.com', 1, 0, '', '2024-05-10', 's4VbFEmG', '$2y$10$7nuW1TrbvVgGYxh2Qslhhemrr.bPL.0Zb4gk3Z6TO8aSHDI11dQBa', 0),
(219, '33-69010', 'Kenn ', 'Pascua', 'Sunido', 'Zone 3, Triala Guimba Nueva Ecija  3115', '2003-02-10', '09796765587', 'Male', 'kenn@gmail.com', 1, 0, '', '2024-05-10', 'us5Ij70A', '$2y$10$opqUah1FhbZCfU7wNiEU4e5e87HNWihVMaK4j.tOmj0MK4W6Ix.km', 0),
(220, '10-54425', 'Kenn ', 'Pascua', 'Sunido', 'Zone 3, Triala Guimba Nueva Ecija  3115', '2003-02-10', '09796765587', 'Male', 'kennsunido94@gmail.com', 1, 0, '', '2024-05-10', 'NmbXoPJU', '$2y$10$ir8EIHHdSyA8jQv7H5hux.5.YcJVT9U3VWQxoJELKIcdRnN6kGU5O', 0),
(221, '87-39794', 'Ganda', 'Ko ', 'Sobra', 'Yuson  Guimba 3115', '2003-02-09', '09229982735', 'Male', 'rafaeltosper@gmail.com', 1, 0, '', '2024-05-10', 'nijV7bYh', '$2y$10$fdOuQycQmo.PYYoyMFHuxuV8ab86WDThit1d1OnE5Byf.XCZV5e/O', 0),
(222, '74-00962', 'Bugoy', 'Na', 'Goodboy', 'Macatcatuit Guimba hindi pa okay 1003', '1939-12-30', '09228118229', 'Male', 'babybuttog@gmail.com', 1, 0, '', '2024-05-10', 'bTvr9LWZ', '$2y$10$s14YK1GPcCOEGZvNE6fwvuGbVLWJlDkNGg21S6N9mRJxnA1j4EHri', 0),
(223, '35-86416', 'Marian', 'Cabiso', 'Simon', 'Purok 4 Cavite,Guimba,Nueva Ecija Guimba Nueva Ecija 3115', '2002-12-10', '09677680471', 'Female', 'mariansimon872@gmail.com', 1, 0, '', '2024-05-10', 'sgFQkChj', '$2y$10$Gb.gB0qE/L.G4jdTxYMfXOm7.NBCNelTaLqp//5QTBEX0Om27rLcO', 0),
(224, '35-35654', 'Bugoy', 'Na', 'Goodboy', 'Macatcatuit Guimba hindi pa okay 1003', '0000-00-00', '09228118229', 'Male', 'shoustonharvey@gmail.com', 1, 0, '325672046_877142506839319_7386932575144857015_n.jpg', '2024-05-10', 'J3eWrXto', '$2y$10$gSPDOg67isGzu8GfVXtNYeInmENaAIe40q4.ypzj6IwnP/T5DhgTa', 0),
(225, '83-87958', 'Marie Lorain', 'Diamsay', 'Perona', 'Bagong Barrio Guimba Nueva Ecija 3115', '2002-01-01', '09914805783', 'Female', 'peronamarie9@gmail.com', 1, 0, '', '2024-05-10', 'RMPY61j0', '$2y$10$e4c1LyvAKVWQqMC0Qv6BOexnZdirYgc1biAmy5/Wp0kYvDePD9dpm', 0),
(226, '60-23097', 'Jiem', '', 'j', 'da12 dad dadasd 3124124', '1939-05-27', '342', 'Male', 'jiemjiem53@gmail.com', 1, 0, '', '2024-05-10', 'pkkzjiIz', '$2y$10$qHC1yBWoYYPWprUOleq.sOQyY6Iq.5k2M7b3uWUPbSQ34UJKcPJTq', 0),
(227, '97-33541', 'Mharco', 'Angelo', 'Vista', 'baliwag nabotas Star Hindi pa okay 1002', '1939-08-11', '09221910774', 'Female', 'mharcoangelov@gmail.com', 1, 0, '', '2024-05-10', '4TuliAOv', '$2y$10$nHOEpeeDDV5JDVQiXkclWOUftMg1yq/qRl6nfVtnL3erRUvhp6PCi', 0),
(228, '79-87432', 'KALAMARES', 'KARANER', 'SUMAKAS', 'triala KALAMARES BAYAN 3115', '2002-05-14', '09765678675', 'Male', 'nu2651837@gmail.com', 1, 0, '', '2024-05-10', 'X5Eyd74k', '$2y$10$eylay2cmB2pNgsNcjX2i2OjPZV.fnKnS4PP5MVXBzacX0P809PGc6', 0),
(229, '39-47567', 'KALAMARES', 'KARANER', 'SUMAKAS', 'triala KALAMARES BAYAN 3115', '2002-05-14', '09765678675', 'Male', 'nu2651837@gmail.com', 1, 0, '', '2024-05-10', 'T3dkJNOJ', '$2y$10$JZjh1BVzF3JMhTsRX3r9kOV22FNT66jw1yFbHMrLWys8ziPv8Nipe', 0),
(230, '93-74764', 'KALAMARES', 'KARANER', 'SUMAKAS', 'triala KALAMARES BAYAN 3115', '2002-05-14', '09765678675', 'Male', 'nu2651837@gmail.com', 1, 0, '', '2024-05-10', 'PTKESpsS', '$2y$10$w4WuDBZJGK/FSBDnSEaRDeV0CR8jmlqLQICNPc5HPdMpQpl/UxPjC', 0),
(231, '38-88958', 'KALAMARES', 'KARANER', 'SUMAKAS', 'triala KALAMARES BAYAN 3115', '2002-05-14', '09765678675', 'Male', 'nu2651837@gmail.com', 1, 0, '', '2024-05-10', 'tM8kskMi', '$2y$10$4YtfZhRwWQSyr2m0flTaceVHPq3Q2CC.CSP3i8f6Ak9CDApDX3TGK', 0),
(232, '69-87447', 'grabe', 'solid', 'magselos', 'lambingin kulang sa lambing 6969', '1939-06-10', '09812317232', 'Male', 'grabe@gmail.com', 1, 0, '', '2024-05-10', 'zKehOLpC', '$2y$10$7TmHhazvJ7/TVXHIjzKON.NnDCPtRG3o4JaUMwu1p/PD7qYRdb9nO', 0),
(233, '23-22689', 'John Vincent', 'Marquez', 'Prado', 'Purok 3, Brgy. San Roque Guimba Nueva Ecija 3115', '2001-10-15', '09279768404', 'Male', 'pradojohnvincent151607@gmail.com', 1, 0, '', '2024-05-17', 'gIcpAD1V', '$2y$10$mqyrLhGC4cAIdQlrhayasuYR2B4zaqgC5aUWXLEbnX9RJGQpZWbE.', 0),
(234, '78-40734', 'jhon henrick', 'burats', 'lucas', 'lennec, guimba cuyapo, nueva cecija nueva ecija guimba 3115', '2002-11-22', '09454354553', 'Male', 'jhonlucas406@gmail.com', 1, 0, '', '2024-05-17', 'S2ySRLGP', '$2y$10$hME/CUNqaC/utRfZUQLZwe2SUkkyE/nYJLUmU5yzTS0UO53QUyQKO', 0),
(245, '87-55483', 'Carl John', 'Quibuyen', 'Yasay', 'Macatcatuit Guimba Nueva Ecija 3115', '2006-05-23', '09450059036', 'Male', 'carl09450059036@gmail.com', 1, 0, '', '2024-05-24', '9j2P8CF4', '$2y$10$DjFqMB5z1kFX6TY10QkU4e4fyE.E1xllFdrUtHTU3rnLqA9GMSWjO', 0),
(247, '67-14044', 'Carl', 'Quibuyen', 'Yasay', 'Zone 7, Macatcatuit Guimba Nueva Ecija 3115', '2006-05-16', '09450059036', 'Male', 'carl09450059036@gmail.com', 1, 0, '', '2024-05-25', '6rcGtJg2', '$2y$10$YGeS9s80ORzzDLnVLvx5M.00n1b4X8J.Ne5KvNQN1FUjzL/z4bBeu', 0),
(248, '67-10184', 'Carl John', 'Q', 'Yasay', 'Macatcatuit, Guimba, N.E', '2006-05-15', '09450059036', 'Male', 'carl09450059036@gmail.com', 1, 5, '', '2024-05-25', 'BymK7af9', '$2y$10$e3PEhpZRE1sT9qicqpb6T.qW.bppN9xw9w1wTCx2a0N0dYRu9Ao7i', 0),
(249, '87-88580', 'Carl John Danie', 'Quibuyen', 'Yasay', 'Macatcatiut Guimba', '2006-05-23', '09450059036', 'Male', 'carl09450059036@gmail.com', 1, 5, '', '2024-05-26', 'J3YEnEpG', '$2y$10$lrieCPfm4.bTiEu7i8ymNOt1r7cMYkQjI2g5lY2l6aQS.VTjhA9r2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_bonus`
--

CREATE TABLE `employee_bonus` (
  `id` int(11) NOT NULL,
  `date_bonus` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `bonus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_deductions`
--

CREATE TABLE `employee_deductions` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `deduction_id` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = Monthly, 2 = Semi-Montly, 3 = Once',
  `effective_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_deductions`
--

INSERT INTO `employee_deductions` (`id`, `employee_id`, `deduction_id`, `type`, `effective_date`, `date_created`) VALUES
(1, '51-04964', 4, 1, '0000-00-00', '2024-05-11 00:27:37'),
(2, '61-03893', 4, 1, '0000-00-00', '2024-05-19 03:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `interview_details`
--

CREATE TABLE `interview_details` (
  `id` int(30) NOT NULL,
  `application_id` int(30) NOT NULL,
  `applicant_id` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `interview_details`
--

INSERT INTO `interview_details` (`id`, `application_id`, `applicant_id`, `email`, `position`, `date`, `time`, `location`) VALUES
(1, 40, '34-8246', 'mharcoangelov@gmail.com', 'Teacher', '2024-05-25', '09:45:00', 'OLSHCO GUIMBA'),
(2, 51, '89-4969', 'carl09450059036@gmail.com', 'Teacher', '2024-05-25', '10:30:00', 'OLSHCO GUIMBA'),
(3, 52, '82-6961', 'carl09450059036@gmail.com', 'Teacher', '2024-05-26', '10:30:00', 'OLSHCO GUIMBA');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date_requested` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `leave_type`, `start_date`, `end_date`, `duration`, `reason`, `status`, `date_requested`) VALUES
(1, '61-03893', 'Sick Leave', '2024-05-06', '2024-05-09', 3, 'Happy Birthday', 'Pending', '2024-05-06 10:53:04'),
(2, '55-51991', 'Sick Leave', '2024-05-13', '2024-05-13', 0, '0898967876878', 'Pending', '2024-05-10 06:43:48'),
(3, '89-60394', 'Vacation Leave', '2024-05-13', '2024-05-27', 14, 'please approve my leave thank you', 'Pending', '2024-05-10 06:45:19'),
(4, '87-39794', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'Gumaganda sobra', 'Pending', '2024-05-10 06:45:25'),
(5, '75-99052', 'Sick Leave', '2024-06-11', '2024-06-12', 1, 'sakit ulo ko, lasing pako eh', 'Pending', '2024-05-10 06:46:11'),
(6, '24-74591', 'Vacation Leave', '2024-06-11', '2024-06-11', 0, 'babakasyon', 'Pending', '2024-05-10 06:47:47'),
(7, '68-72933', 'Vacation Leave', '2024-05-13', '2024-06-07', 25, '626563463454387548754', 'Pending', '2024-05-10 06:50:57'),
(8, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, '\r\nNAGTATAE', 'Pending', '2024-05-10 06:49:18'),
(9, '68-72933', 'Vacation Leave', '2024-06-06', '2024-06-26', 20, 'hjgjgj', 'Pending', '2024-05-10 06:49:23'),
(10, '32-36055', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'Sasamahan ko aso ko', 'Pending', '2024-05-10 06:49:44'),
(11, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'NEED SPACE', 'Pending', '2024-05-10 06:49:55'),
(12, '87-41587', 'Sick Leave', '2024-05-13', '2024-05-13', 0, 'nagtatae', 'Pending', '2024-05-10 06:50:16'),
(13, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'ALA LANG', 'Pending', '2024-05-10 06:50:31'),
(14, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'BAT BA GUSTO KO NGA MAG LEAVE...\r\n', 'Pending', '2024-05-10 06:51:02'),
(15, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'SHOCKS', 'Pending', '2024-05-10 06:51:17'),
(16, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'LEAVE NA PLS', 'Pending', '2024-05-10 06:51:33'),
(17, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'DUHHHHHH', 'Pending', '2024-05-10 06:51:54'),
(18, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'GRRRRRRRR', 'Pending', '2024-05-10 06:52:03'),
(19, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'HYSSSSSS', 'Pending', '2024-05-10 06:52:21'),
(20, '37-24212', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'I WANT TO LEAVE', 'Pending', '2024-05-10 06:52:45'),
(21, '76-13543', 'Emergency Leave', '2024-05-13', '2024-05-13', 0, 'natae sa daan', 'Pending', '2024-05-10 06:53:39'),
(22, '68-72933', 'Bereavement Leave', '2024-05-13', '2024-05-13', 0, '#%$^^&&&**&*&&@*&*#@', 'Pending', '2024-05-10 06:54:27'),
(23, '44-12435', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'Natatae', 'Pending', '2024-05-10 06:54:52'),
(24, '76-13543', 'Emergency Leave', '2024-06-03', '2024-06-19', 16, 'sinundan ko si crush naligaw ako', 'Pending', '2024-05-10 06:54:52'),
(25, '44-12435', 'Vacation Leave', '2024-05-13', '2024-05-13', 0, 'Nauutot', 'Pending', '2024-05-10 06:55:49'),
(26, '35-35654', 'Family or Personal Leave', '2024-05-13', '2024-05-13', 0, '12313', 'Pending', '2024-05-10 06:59:02'),
(30, '61-03893', 'Vacation Leave', '2024-05-17', '2024-05-21', 4, 'Boracay', 'Pending', '2024-05-14 04:46:28'),
(31, '78-40734', 'Vacation Leave', '2024-05-20', '2024-06-28', 39, 'bakit gusto ko lang TAGAPAG MANA AKO NG KUMPANYA NATO!!!!!!!!!!!', 'Pending', '2024-05-17 00:19:08'),
(32, '23-22689', 'Vacation Leave', '2024-05-20', '2024-05-20', 0, 'hatdog', 'Pending', '2024-05-17 00:19:39'),
(33, '61-03893', 'Emergency Leave', '2024-05-24', '2024-06-28', 35, 'Masakit daw ulo', 'Pending', '2024-05-24 01:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `total_overtime_pay` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `employee_id`, `hours`, `rate`, `total_overtime_pay`, `date_overtime`) VALUES
(6, '51-04964', 2.25, 75, 168.75, '2024-04-28'),
(7, '61-03893', 20.2, 75, 1515, '2024-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in_AM` time NOT NULL,
  `time_out_AM` time NOT NULL,
  `time_in_PM` time NOT NULL,
  `time_out_PM` time NOT NULL,
  `total_hours` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in_AM`, `time_out_AM`, `time_in_PM`, `time_out_PM`, `total_hours`) VALUES
(5, '07:00:00', '11:30:00', '13:30:00', '17:30:00', 8.50);

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `id` int(30) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `availability` int(30) NOT NULL,
  `details` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rate` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id`, `banner`, `position`, `availability`, `details`, `description`, `status`, `rate`, `date_created`) VALUES
(1, 'file-teaching-skills-1605625101.jpg', 'Teacher', 28, 'A teacher, also called a schoolteacher or formally an educator, is a person who helps students to acquire knowledge, competence, or virtue, via the practice of teaching.', '<h2><b>URGENT HIRING!!</b></h2><p></p><h3><b><b>&nbsp;Our school is looking for 10 new Teacher.</b></b></h3><p></p><h2><b><b><b>Qualifications:</b></b></b></h2><p></p><p></p><h4><ul><li><b><b><b><b>Bachelors Degree in Education</b></b></b></b></li></ul><ul><li><b><b><b>Valid Teaching Certification</b></b></b></li></ul><ul><li><b><b><b>Proven Teaching Experience in any grade level</b></b></b></li></ul><ul><li><b><b><b>Strong Communication and Interpersonal Skills</b></b></b></li></ul><ul><li><b><b><b>Passion for Lifelong Learning and Professional Development</b></b></b></li></ul></h4><p></p>', 1, 5000, '2020-09-28 11:24:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_bonus`
--
ALTER TABLE `employee_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_deductions`
--
ALTER TABLE `employee_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interview_details`
--
ALTER TABLE `interview_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `employee_bonus`
--
ALTER TABLE `employee_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_deductions`
--
ALTER TABLE `employee_deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interview_details`
--
ALTER TABLE `interview_details`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
