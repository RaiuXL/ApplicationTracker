DROP TABLE IF EXISTS `Users`;
DROP TABLE IF EXISTS `Applications`;
DROP TABLE IF EXISTS `AdminAnnouncements`;
DROP TABLE IF EXISTS `InactiveApplications`;


CREATE TABLE IF NOT EXISTS Users (
	userId int AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cohortNum VARCHAR(255) NOT NULL,
    appUseOptions VARCHAR(255) DEFAULT NULL,
    customNotes VARCHAR(255) NOT NULL,
    isAdmin BIT NOT NULL DEFAULT 0,
    createdTime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    username VARCHAR(255) DEFAULT "username",
    password VARCHAR(255) DEFAULT "password"
);

CREATE TABLE IF NOT EXISTS Applications (
    applicationId int AUTO_INCREMENT PRIMARY KEY,
    userId int NOT NULL,
    jobPosition varchar(255) NOT NULL,
    descriptionURL varchar(255) NOT NULL,
    status varchar(50) NOT NULL, 
    notes varchar(500),
    dateApplied date DEFAULT CURRENT_DATE NOT NULL,
    followUpDate date NOT NULL,
    appliedAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,

   FOREIGN KEY(userId) REFERENCES Users(userId)
);

CREATE TABLE IF NOT EXISTS AdminAnnouncements (
    announcementId int AUTO_INCREMENT PRIMARY KEY,
    userId int NOT NULL,
    title varchar(255) NOT NULL,
    jobType varchar(20) NOT NULL,
    location varchar(255) NOT NULL,
    employer varchar(255) NOT NULL, 
    moreInfo varchar(255) NOT NULL,
    url varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    createdDate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY(userId) REFERENCES Users(userId)
);

CREATE TABLE IF NOT EXISTS InactiveApplications LIKE Applications;
CREATE TABLE IF NOT EXISTS InactiveUsers LIKE Users;

INSERT INTO Users (firstName, lastName, email, cohortNum, appUseOptions, customNotes, isAdmin, username, password)
VALUES ("Admin", "Adminson", "admin@security.com", 1, "Not Actively Searching", "All Important", 1, "admin", "admin");

INSERT INTO Users (firstName, lastName, email, cohortNum, appUseOptions, customNotes)
VALUES ("Fredrickson", "Smith", "thatguy@gmail.com", 19, "Seeking Internship", "Companies should be honored to interview me.");

INSERT INTO Users (firstName, lastName, email, cohortNum, appUseOptions, customNotes)
VALUES ("Realname", "Actualperson", "notafakeemail@gmail.com", 12, "Seeking Job", "I'm looking for a position and would like to track my applications!");

INSERT INTO Users (firstName, lastName, email, cohortNum, appUseOptions, customNotes)
VALUES ("George", "Washington", "unitedstates@gmail.gov", 28, "Seeking Internship", "Looking to broaden my resume with internships.");

INSERT INTO Users (firstName, lastName, email, cohortNum, appUseOptions, customNotes)
VALUES ("John", "Doe", "unknown@greenriver.edu", 14, "Not actively searching", "Will be looking for jobs in the future");

INSERT INTO Users (firstName, lastName, email, cohortNum, appUseOptions, customNotes)
VALUES ("Firstname", "Lastname", "everything@gmail.com", 66, "Seeking Internship", "Looking for money.");

INSERT INTO Applications (userId, jobPosition, descriptionURL, status, notes, dateApplied, followUpDate)
VALUES (1, "Google CEO", "https://google.com", "Interviewing", "Apply to become the Google CEO! 1-3 years professional experience preferred.", "2024-06-12", "2024-08-12");

INSERT INTO Applications (userId, jobPosition, descriptionURL, status, notes, dateApplied, followUpDate)
VALUES (1, "Entry-Level Frontend Developer", "https://amazon.com", "Rejected", "Love this company.", "2024-04-15", "2024-04-25");

INSERT INTO Applications (userId, jobPosition, descriptionURL, status, notes, dateApplied, followUpDate)
VALUES (1, "Senior-Level Product Manager", "https://bing.com", "Accepted", "No one else applied!", "2024-03-12", "2024-03-13");

INSERT INTO Applications (userId, jobPosition, descriptionURL, status, notes, dateApplied, followUpDate)
VALUES (1, "DevOps", "https://devops.com", "Accepted", "Doing some DevOps stuff", "2024-06-18", "2024-09-13");

INSERT INTO Applications (userId, jobPosition, descriptionURL, status, notes, dateApplied, followUpDate)
VALUES (1, "Ram Downloading Engineer", "http://downloadram.com", "Accepted", "Downloading RAM", "2024-06-20", "2025-04-09");

INSERT INTO Applications (userId, jobPosition, descriptionURL, status, notes, dateApplied, followUpDate)
VALUES (1, "Five Days Ago Engineer", "http://calender.com", "Accepted", "Testing Dates", "2024-02-20", "2024-03-01");

INSERT INTO Applications (userId, jobPosition, descriptionURL, status, notes, dateApplied, followUpDate)
VALUES (1, "Five Days Later Engineer", "http://calendernow.com", "Rejected", "Enjoying Dates", "2024-02-20", "2024-03-6");

INSERT INTO AdminAnnouncements (userId, title, jobType, location, employer, moreInfo, url, email)
VALUES (1, "Really Cool Position for you!", "Full-Time", "Indiana", "Really Cool Employer", "Contact for more information.", "https://google.com", "email@email.com");

INSERT INTO AdminAnnouncements (userId, title, jobType, location, employer, moreInfo, url, email)
VALUES (1, "Not a really cool position booooo!!", "Unpaid Internship", "Rhode Island", "Bad employer", "Fax resume for more information.", "https://bing.com", "test@bademail.com");

