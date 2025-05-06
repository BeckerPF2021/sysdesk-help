CREATE TABLE UserGroup (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE Department (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE TicketStatus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE TicketPriority (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fk_UserGroup_id INT,
    FOREIGN KEY (fk_UserGroup_id) REFERENCES UserGroup(id) ON DELETE CASCADE
);

CREATE TABLE Ticket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    fk_User_id INT,
    fk_Category_id INT,
    fk_TicketPriority_id INT,
    fk_TicketStatus_id INT,
    fk_Department_id INT,
    FOREIGN KEY (fk_User_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (fk_Category_id) REFERENCES Category(id) ON DELETE RESTRICT,
    FOREIGN KEY (fk_TicketPriority_id) REFERENCES TicketPriority(id) ON DELETE RESTRICT,
    FOREIGN KEY (fk_TicketStatus_id) REFERENCES TicketStatus(id) ON DELETE RESTRICT,
    FOREIGN KEY (fk_Department_id) REFERENCES Department(id) ON DELETE CASCADE
);

CREATE TABLE TicketHistory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    action TEXT NOT NULL,
    fk_Ticket_id INT,
    fk_User_id INT,
    FOREIGN KEY (fk_Ticket_id) REFERENCES Ticket(id) ON DELETE RESTRICT,
    FOREIGN KEY (fk_User_id) REFERENCES Users(id) ON DELETE RESTRICT
);

CREATE TABLE TicketInteraction (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(500) NOT NULL,
    comment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    interaction_type INT,
    file_type VARCHAR(100),
    file_size BIGINT,
    fk_User_id INT,
    fk_Ticket_id INT,
    FOREIGN KEY (fk_User_id) REFERENCES Users(id) ON DELETE RESTRICT,
    FOREIGN KEY (fk_Ticket_id) REFERENCES Ticket(id) ON DELETE RESTRICT
);

CREATE TABLE Notification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('email', 'popup') NOT NULL,
    status ENUM('pending', 'sent', 'error') NOT NULL,
    date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    fk_TicketInteraction_id INT,
    fk_Ticket_id INT,
    FOREIGN KEY (fk_TicketInteraction_id) REFERENCES TicketInteraction(id) ON DELETE CASCADE,
    FOREIGN KEY (fk_Ticket_id) REFERENCES Ticket(id) ON DELETE CASCADE
);
