# Schema

```
CREATE TABLE IF NOT EXISTS "networks"(
        `id`    INTEGER NOT NULL,
        `network`      TEXT NOT NULL,
        `cidr`  INTEGER,
        `note` TEXT,
        PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS "hosts" (
	`id`	INTEGER NOT NULL,
	`ip_address`	TEXT NOT NULL,
	`subnet_mask`	TEXT NOT NULL,
	`host`	TEXT,
	`mac1`  TEXT,
        `mac2`  TEXT,
	`note`	TEXT,
	PRIMARY KEY(`id`)
);
```
