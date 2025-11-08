# Schema

```
CREATE TABLE IF NOT EXISTS "networks"(
        `id` INTEGER NOT NULL,
        `network` TEXT NOT NULL,
        `cidr` INTEGER,
        `note` TEXT,
        PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS "hosts" (
	`id` INTEGER NOT NULL,
	`address` TEXT NOT NULL,
	`host` TEXT,
	`mac` TEXT,
	`note` TEXT,
	PRIMARY KEY(`id`)
);
```
