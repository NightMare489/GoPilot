# GoPilot
### ![N|Solid](https://img.icons8.com/?size=20&id=77&format=png) About
No car? No problem. GoPilot connects you with a network of reliable drivers, ready to whisk you to or from any airport. Ditch the rental queues, parking fees, and traffic woes. GoPilot puts you back in control.

### ![N|Solid](https://img.icons8.com/?size=20&id=7867&format=png) Website Link
[GoPilot](http://gopilot.great-site.net)

## 🔰 Installation
- To run locally, easiest way is to use the latest version of [XAMPP](https://www.apachefriends.org/).
- Put the project under `htdocs` folder inside `XAMPP` folder under the name `gopilot`.
- Make sure you created the database queries.
- Open http://localhost/gopilot.

## ![N|Solid](https://img.icons8.com/?size=25&id=1476&format=png) Database queries
# Users Table
```sql
CREATE TABLE users(
    id INT UNIQUE not null AUTO_INCREMENT,
    name varchar(30) not null,
    email varchar(30) UNIQUE not null,
    phonenumber varchar(15) UNIQUE not null,
    password varchar(50) not null,
    url varchar(50) default "goicons/AboutUs.png"
);
```
# Flights Table
```sql
CREATE TABLE Flights(
    id  INT not null AUTO_INCREMENT  PRIMARY KEY,
    flightnumber varchar(20) NOT null,
    f_from varchar(100) not null,
    f_to varchar(100) not null,
    f_time Time not null,
    f_date Date not null,
    f_timeTaken Time not null
    );
    

```

# Airports Table
```sql
create TABLE Airports(
    id int AUTO_INCREMENT not null UNIQUE,
    name varchar(100) not null,
    lat varchar(100) not null,
    lon varchar(100) not null
)
    INSERT INTO `Airports`(`name`, `lat`, `lon`) VALUES ('Aswan','23.968351930794917','32.824847023467406');
    INSERT INTO `Airports`(`name`, `lat`, `lon`) VALUES ('Cairo','30.11237935162788', '31.396211093097634');
    INSERT INTO `Airports`(`name`, `lat`, `lon`) VALUES ('Sohag','26.33932429041654', '31.73788757070532');
INSERT INTO `Airports`(`name`, `lat`, `lon`) VALUES ('Hurghada','27.180532152775328', '33.80753380923471');
INSERT INTO `Airports`(`name`, `lat`, `lon`) VALUES ('Sharm El Sheikh','27.98084388519482', '34.38309546769676');
```
# Tickets Table

```sql
CREATE TABLE Tickets(
id  int not null PRIMARY KEY AUTO_INCREMENT,
    TicketID varchar(15) not null unique,
    T_date date not null,
    T_Time time not null,
    T_Persons int not null,
    T_bags int not null,
    T_ET varchar(100) not null,
    T_Price int not null,
    T_from varchar(100) not null,
    T_To varchar(100) not null,
    lat varchar(100) not null,
    lon varchar(100) not null,
    T_userRef int not null,
    T_FlightID int not null,
    
    FOREIGN KEY (T_userRef) REFERENCES users(id),
    FOREIGN KEY (T_FlightID) REFERENCES Flights(id)
);

```

### Created By
- Yaser Mohamed Shaban (Me)
- Amr Ashraf Omar [AmrEL3taaL](https://github.com/AmrEL3taaL)
- Omar Mohamed Farouk [OmrFarook](https://github.com/OmrFarook)
