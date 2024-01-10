DROP DATABASE IF EXISTS `timtube`;

CREATE DATABASE `timtube`;

USE `timtube`;

CREATE TABLE `admins` (
    id BINARY(60) DEFAULT UUID() PRIMARY KEY,
    admin_email VARCHAR(30) NOT NULL,
    admin_password VARCHAR(255) NOT NULL,
    picture VARCHAR(255) NOT NULL
);

INSERT INTO `admins` (`admin_email`, `admin_password`, `picture`) VALUES
    ('admin@timtube.nl', 'timtube_admin1', 'https://cdn-icons-png.flaticon.com/512/2304/2304226.png');

CREATE TABLE `users` (
    id BINARY(60) DEFAULT UUID() PRIMARY KEY,
    user_email VARCHAR(25) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    username VARCHAR(20) NOT NULL,
    permissions VARCHAR(20) NOT NULL,
    picture VARCHAR(255) NOT NULL
);

CREATE TABLE `videos` (
	id MEDIUMINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(100) NOT NULL,
    tumbnail VARCHAR(200) NOT NULL,
    channelName VARCHAR(255) NOT NULL,
    channelPicture VARCHAR(255) NOT NULL,
    views INT(255) NOT NULL,
    subs VARCHAR(100) NOT NULL,
    likes VARCHAR(5) NOT NULL,
    postDate VARCHAR(15) NOT NULL,
    videoURL VARCHAR(20) NOT NULL,
    videoDescription MEDIUMTEXT NULL,
    comments JSON NULL
);

INSERT INTO `videos` (`title`, `tumbnail`, `channelName`, `channelPicture`, `views`, `subs`, `likes`, `postDate`, `videoURL`, `videoDescription`) VALUES
    ('De Rechtzaak van Reuzegom tegen Mij', 'https://i.ytimg.com/vi/eF0fivAloVc/hq720.jpg?sqp=-oaymwEcCOgCEMoBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLD26SkJcBBLjp8XxHVNpWNI_QkmRw', 'ACID 2', 'https://yt3.ggpht.com/BtntDS-06EwHDl9WTzZ5HIgHXVFT76_dSHykp_gOWWNfkEXrTlCLHdPhf1b49RhA3b27KEMGcF0=s68-c-k-c0x00ffffff-no-rj', '20', '500k', '8', '3 weeks ago', 'eF0fivAloVc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae facilisis ipsum. In nec ex ut augue scelerisque lacinia. Sed bibendum tortor in augue finibus, eu aliquam odio tincidunt. Nullam sed nisi a dolor luctus ultrices. Suspendisse auctor, velit eget euismod gravida, tortor eros viverra libero, eget tempus est quam in ex. Nunc a rhoncus turpis. Proin non massa non libero fringilla accumsan. Fusce ac turpis at erat venenatis tincidunt in id enim. Nulla facilisi. Cras lacinia massa a sapien sagittis, at cursus elit tempor. Sed lacinia sapien vel felis luctus, vel facilisis libero lacinia. Morbi rhoncus vehicula nunc, non interdum elit eleifend vel. Vivamus pulvinar, nisl a tempus luctus, velit velit cursus justo, vel tincidunt libero odio in dui.'),
    ('How programmers flex on each other', 'https://i.ytimg.com/vi/r6tH55syq0o/hq720.jpg?sqp=-oaymwEcCNAFEJQDSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLAiWrd9YeHQbVU_Fvgc91DxYLjB5w', 'Fireship', 'https://yt3.ggpht.com/ytc/APkrFKb--NH6RwAGHYsD3KfxX-SAgWgIHrjR5E4Jb5SDSQ=s68-c-k-c0x00ffffff-no-rj', '5', '2M', '27', '1 month ago', 'r6tH55syq0o', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae facilisis ipsum. In nec ex ut augue scelerisque lacinia. Sed bibendum tortor in augue finibus, eu aliquam odio tincidunt. Nullam sed nisi a dolor luctus ultrices. Suspendisse auctor, velit eget euismod gravida, tortor eros viverra libero, eget tempus est quam in ex. Nunc a rhoncus turpis. Proin non massa non libero fringilla accumsan. Fusce ac turpis at erat venenatis tincidunt in id enim. Nulla facilisi. Cras lacinia massa a sapien sagittis, at cursus elit tempor. Sed lacinia sapien vel felis luctus, vel facilisis libero lacinia. Morbi rhoncus vehicula nunc, non interdum elit eleifend vel. Vivamus pulvinar, nisl a tempus luctus, velit velit cursus justo, vel tincidunt libero odio in dui.'),
    ('Understanding Protocols | Networking for Hackers', 'https://i.ytimg.com/vi/r6lzdyzO4EY/hq720.jpg?sqp=-oaymwEcCNAFEJQDSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLBE0hjh_zRQekmuaGCGxqMM49pD4g', 'OCSALY Academy by Typhon', 'https://yt3.ggpht.com/GmUUU3bvYCqUJG0DlnhlCivQvwH5WPsMqIDG4VPPgNPJuRTmAOLpcNlIRzUv-ZTHkdZEtbMmgg=s68-c-k-c0x00ffffff-no-rj', '8', '200k', '23', '2 months ago', 'r6lzdyzO4EY', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae facilisis ipsum. In nec ex ut augue scelerisque lacinia. Sed bibendum tortor in augue finibus, eu aliquam odio tincidunt. Nullam sed nisi a dolor luctus ultrices. Suspendisse auctor, velit eget euismod gravida, tortor eros viverra libero, eget tempus est quam in ex. Nunc a rhoncus turpis. Proin non massa non libero fringilla accumsan. Fusce ac turpis at erat venenatis tincidunt in id enim. Nulla facilisi. Cras lacinia massa a sapien sagittis, at cursus elit tempor. Sed lacinia sapien vel felis luctus, vel facilisis libero lacinia. Morbi rhoncus vehicula nunc, non interdum elit eleifend vel. Vivamus pulvinar, nisl a tempus luctus, velit velit cursus justo, vel tincidunt libero odio in dui.')

