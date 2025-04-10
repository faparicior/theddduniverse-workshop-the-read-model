create table main.advertisements
(
    id TEXT not null constraint advertisements_pk primary key,
    description TEXT,
    password TEXT,
    email TEXT,
    advertisement_date TEXT,
    status TEXT,
    approval_status TEXT,
    user_id TEXT,
    civic_center_id TEXT
);

create table main.users
(
    id TEXT not null constraint advertisements_pk primary key,
    email TEXT,
    password TEXT,
    role TEXT,
    member_number TEXT,
    civic_center_id TEXT,
    status TEXT
);

create table main.advertisements_stats
(
    civic_center_id TEXT not null constraint advertisements_stats_pk primary key,
    advertisement_count INTEGER,
    user_count INTEGER,
    approved_count INTEGER,
    disabled_count INTEGER,
    pending_count INTEGER
);
