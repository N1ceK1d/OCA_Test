CREATE TABLE Characteristics (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Questions (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_text VARCHAR(255) NOT NULL,
    characteristic_id INT NOT NULL,
    FOREIGN KEY (characteristic_id) REFERENCES Characteristics (id)
);

CREATE TABLE Answers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    answer_text VARCHAR(255) NOT NULL,
    question_id INT NOT NULL,
    points INT NOT NULL,
    FOREIGN KEY (question_id) REFERENCES Questions (id)
);

CREATE TABLE Admins (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(255) NOT NULL,
    password LONGTEXT NOT NULL
);

CREATE TABLE Companies (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Customers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(255) NOT NULL,
    password LONGTEXT NOT NULL,
    company_id INT NOT NULL,
    answers_count INT,
    time_count DATETIME,
    FOREIGN KEY (company_id) REFERENCES Companies (id)
);

CREATE TABLE Genders (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255),
    second_name VARCHAR(255),
    company_id INT NOT NULL,
    gender INT NOT NULL,
    test_time DateTime,
    FOREIGN KEY (company_id) REFERENCES Companies (id),
    FOREIGN KEY (gender) REFERENCES Genders (id)
);

CREATE TABLE UserAnswers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    answer_id INT NOT NULL,
    question_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users (id),
    FOREIGN KEY (answer_id) REFERENCES Answers (id),
    FOREIGN KEY (question_id) REFERENCES Questions (id)
);