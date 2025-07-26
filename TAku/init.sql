CREATE DATABASE IF NOT EXISTS smartfarm;
USE smartfarm;

CREATE TABLE IF NOT EXISTS sensor_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sensor_id VARCHAR(50),
    temperature FLOAT,
    humidity FLOAT,
    soil_moisture FLOAT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);
