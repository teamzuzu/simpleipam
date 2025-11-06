CREATE TABLE IF NOT EXISTS 'networks' (
        'id' INTEGER NOT NULL,
        'network' TEXT NOT NULL,
        'cidr' INTEGER,
        'note' TEXT,
        PRIMARY KEY(`id`)
);

INSERT INTO networks VALUES(1,'10.0.10.0',24,'US Network');
INSERT INTO networks VALUES(2,'10.0.88.0',24,'Production DMZ Operation EU');
INSERT INTO networks VALUES(3,'10.0.12.0',24,'Production DMZ Operation CN');
INSERT INTO networks VALUES(4,'10.4.18.0',24,'Production DMZ Operation ZK');
INSERT INTO networks VALUES(5,'10.0.23.0',24,'Production DMZ Operation EU2');
INSERT INTO networks VALUES(6,'10.3.58.0',24,'Production DMZ Operation PT');
INSERT INTO networks VALUES(7,'10.2.75.0',24,'Production DMZ Operation LOC-1');
INSERT INTO networks VALUES(8,'10.0.42.0',24,'NPOLE VPN');

CREATE TABLE IF NOT EXISTS 'hosts' (
	`id` INTEGER NOT NULL,
	`address` TEXT NOT NULL UNIQUE,
	`host` TEXT NOT NULL,
	`mac` TEXT,
	'note' TEXT,
	PRIMARY KEY(`id`)
);

INSERT INTO hosts VALUES(1,'10.0.0.1','test-us','a0:4a:08:85:fc:a2', 'sources');
INSERT INTO hosts VALUES(2,'10.0.18.4','test-eu','f0:0b:28:6a:79:66', 'fund');
INSERT INTO hosts VALUES(3,'10.2.88.222','test-jice','70:4d:97:88:4a:87', 'dynamic');
INSERT INTO hosts VALUES(4,'10.0.38.1','test-xej','82:f4:9e:50:3e:f7', 'note');
INSERT INTO hosts VALUES(5,'10.4.8.44','test-','f0:72:8f:ed:56:72', 'note');
INSERT INTO hosts VALUES(6,'10.0.12.6','test-eui1','00:0b:c4:a1:8b:8c', ' ! note');
INSERT INTO hosts VALUES(7,'10.6.66.1','test-euice','e0:6c:e8:94:d3:4b', 'note');
INSERT INTO hosts VALUES(8,'10.0.23.1','test-euiicoe','3e:1f:b5:da:b9:98', 'note');
INSERT INTO hosts VALUES(9,'10.0.1.12','summer-cioe','08:02:58:ad:13:0d', 'note');
INSERT INTO hosts VALUES(10,'10.9.88.1','test-','30:74:0b:31:a2:11', 'note');
INSERT INTO hosts VALUES(11,'10.0.108.1','pay-euUUU','a0:07:a0:d2:ba:54', 'note');
INSERT INTO hosts VALUES(12,'10.11.23.56','test-cddccd','80:cd:19:53:cd:b1', '26 th server');
INSERT INTO hosts VALUES(13,'10.12.88.1','test-jkjk','2e:08:f3:b8:03:6a', 'bonus server');
