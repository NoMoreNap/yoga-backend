SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
                         `id` int NOT NULL,
                         `title` varchar(255) NOT NULL,
                         `description` text NOT NULL,
                         `similarity` text NOT NULL,
                         `directions` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `similarity`, `directions`) VALUES
                                                                                   (1, 'Йога', 'Йога - это философия здорового образа жизни. Тот, кто занимается йогой, становится здоровее и выносливее, после занятий чувствует прилив сил, а также с новой силой может ощутить вкус к жизни.###Благодаря комплексному воздействию упражнений происходит проработка всех групп мышц, тренировка суставов, улучшается циркуляция крови. Кроме того, упражнения дарят отличное настроение, заряжают бодростью и помогают противостоять стрессам.', 'Давно хотели попробовать йогу, но не решались начать.###Хотите укрепить позвоночник, избавиться от болей в спине и суставах.###Ищете активность, полезную для тела и души.', 'Йога для новичков###Классическая йога###Йогатерапия###Кундалини-йога###Хатха-йога###Аштанга-йога'),
                                                                                   (2, 'Стретчинг', 'Стретчинг (или stretching) – это система упражнений, целью которых является разогрев и растяжка мышц и связок. При этом стретчинг – не просто комплекс упражнений для разминки перед тренировкой, а самостоятельное направление фитнеса, которое может использоваться как в комплексе с другими направлениями, так и самостоятельно.###Стретчинг в домашних условиях может использоваться для многих целей:*Выступает в качестве гимнастики в период восстановления после травм;*Входит в состав программы для похудения;*Помогает развить гибкость и пластичность, при правильном подходе вы сядете на шпагат через несколько недель;*Это эффективный способ расслабиться после трудного дня.', 'Хотите подтянуть тело, смоделировать мышечный корсет###Улучшить осанку и координацию###Улучшить кровообращение и обмен веществ', 'статический###динамический###пассивный###активный'),
                                                                                   (3, 'Бодифлекс', 'BodyFlex – система, в которой особым образом сочетаются физические упражнения на укрепление и растяжку мышц, и дыхательная гимнастика. Такое сочетание приводит к ряду положительных эффектов, которые практически невозможно достичь с помощью других направлений фитнеса. Одна из самых интересных особенностей данной системы заключается в том, что это эффективный фитнес дома.###Весь смысл бодифлекса сводится к правильному дыханию, благодаря которому упражнения на растяжку и укрепление мышц приобретают свою эффективность. При выдыхании воздуха и задержке дыхания организм на короткое время испытывает кислородное голодание, в крови накапливается углекислый газ, что приводит к запуску некоторых физиологических процессов, типичных для ситуации «бей или беги». То есть, организм приходит в состояние повышенной готовности и способен выполнять быстрые и энергичные действия.', 'Хотите укрепить легкие и снизить вероятность заболеваний дыхательной системы###Улучшить пищеварение###Ускорить метаболизм', 'базовый###продвинутый'),
                                                                                   (4, 'Танцевальный фитнес', 'Фитнес и танцы – что между ними общего? А то, что они могут великолепно сочетаться и оказывать просто восхитительный эффект на ваше тело! Объединение хореографии и аэробики – это необычно и интересно, именно так родился танцевальный фитнес, которым вы теперь можете заниматься дома. Достичь отличной формы и при этом получить удовольствие вам поможет видео для похудения, которое мы представляем на этой странице – делайте упражнения, танцуйте и чувствуйте, как ваше тело меняется в лучшую сторону!', 'Хотите укрепить мышцы, но тренировки в тренажерном зале для вас скучные и однообразные###Хотите сбросить лишний вес, но нет желания мучать себя диетами###Любите танцы и хотите совместить приятное с полезным.', 'Зумба###Dance-mix###Caribbean-mix\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                         `id` int NOT NULL,
                         `login` varchar(22) NOT NULL,
                         `pass` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
                         `email` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id` (`id`);
ALTER TABLE `users`
    ADD UNIQUE KEY `id` (`id`);
ALTER TABLE `posts`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

