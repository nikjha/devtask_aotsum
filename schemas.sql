CREATE TABLE country (
  country_id INT AUTO_INCREMENT PRIMARY KEY,
  country_code VARCHAR(5),
  country_name VARCHAR(100)
);

CREATE TABLE state (
  state_id INT AUTO_INCREMENT PRIMARY KEY,
  country_id INT,
  state_code VARCHAR(5),
  state_name VARCHAR(100),
  FOREIGN KEY (country_id) REFERENCES country(country_id)
);

CREATE TABLE city (
  city_id INT AUTO_INCREMENT PRIMARY KEY,
  state_id INT,
  city_code VARCHAR(5),
  city_name VARCHAR(100),
  FOREIGN KEY (state_id) REFERENCES state(state_id)
);

CREATE TABLE course (
  course_id INT AUTO_INCREMENT PRIMARY KEY,
  course_code VARCHAR(10),
  course_name VARCHAR(100)
);

CREATE TABLE student (
  uniq_id INT AUTO_INCREMENT PRIMARY KEY,
  stu_name VARCHAR(60),
  stu_father_name VARCHAR(60),
  stu_mother_name VARCHAR(60),
  stu_gender VARCHAR(20),
  stu_email VARCHAR(100),
  stu_mobile VARCHAR(13),
  stu_address VARCHAR(255),
  state_id INT,
  city_id INT,
  country_id INT,
  date_of_birth DATE,
  stu_age INT,
  course_id INT,
  stu_tenth_per INT,
  stu_twelfth_per INT,
  FOREIGN KEY (state_id) REFERENCES state(state_id),
  FOREIGN KEY (city_id) REFERENCES city(city_id),
  FOREIGN KEY (country_id) REFERENCES country(country_id),
  FOREIGN KEY (course_id) REFERENCES course(course_id)
);

CREATE TABLE course_fee (
  uniq_id INT AUTO_INCREMENT PRIMARY KEY,
  course_id INT,
  duration INT,
  fee INT,
  FOREIGN KEY (course_id) REFERENCES course(course_id)
);