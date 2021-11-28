
-- Inserts name to the clients Database
INSERT INTO `clients`(`clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) 
VALUES ('Tony','Stark','tony@starkent.com','Iam1ronM@n','1','I am the real Ironman');

-- Updates the clientLevel to 3
UPDATE `clients` SET `clientLevel`='3' 
WHERE clientId = 1;

-- Updates and replaces a specific string on the invDescription column
UPDATE `inventory` 
SET `invDescription`= replace(invDescription, "spacious interior", "small interior");

-- Joins to tables together
SELECT  `invMake`, `classificationName` 
FROM inventory i
JOIN carclassification c
ON i.classificationId = c.classificationId
WHERE c.classificationId = 1;

-- Deletes from the inventory table
DELETE 
FROM `inventory`
WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- Updates and concatenate a string at the beginning of other strings
UPDATE `inventory` 
SET invImag = concat('/phpmotors', invImage), invThumbnail = concat('/phpmotors', invThumbnail);

