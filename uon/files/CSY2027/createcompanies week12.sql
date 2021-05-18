REM   Script: Session 01
REM   Firsy

create table companies( 
company_id number(6), 
company_name varchar2(15), 
city varchar2(12), 
industry varchar2(15), 
no_employees number(5), 
revenue number(10,2), 
training_budget number(10,2));

ALTER TABLE companies 
ADD CONSTRAINT pk_companies 
PRIMARY KEY (company_id);

INSERT INTO companies (company_id, company_name, city, industry, no_employees, revenue, training_budget) 
VALUES (10, 'USCABLES', 'WASHINGTON', 'MANUFACTURING', 250, 4000000, 50000.00);

INSERT INTO companies (company_id, company_name, city, industry, no_employees, revenue, training_budget) 
VALUES (20, 'KODAK', 'HOUSTON', 'MANUFACTURING', 2500, 10000000, 100000.00);

INSERT INTO companies (company_id, company_name, city, industry, no_employees, revenue, training_budget) 
VALUES (30, 'KLM', 'AMSTERDAM', 'SERVICE', 5000, 11000000, 990000.00);

INSERT INTO companies (company_id, company_name, city, industry, no_employees, revenue, training_budget) 
VALUES (40, 'HAMBRO', 'LONDON', 'SERVICE', 2000, 6000000, 500000.00);

INSERT INTO companies (company_id, company_name, city, industry, no_employees, revenue, training_budget) 
VALUES (50, 'FORD', 'DETROIT', 'MANUFACTURING', 8000, 20000000, 100000.00);

INSERT INTO companies (company_id, company_name, city, industry, no_employees, revenue, training_budget) 
VALUES (60, 'CITYBANK', 'BOSTON', 'FINANCE', 3000, 5000000, 200000.00);

INSERT INTO companies (company_id, company_name, city, industry, no_employees, revenue, training_budget) 
VALUES (70, 'DISNEY', 'ORLANDO', 'ARTS', 2500, 10000000, 300000.00);

select * from companies;

UPDATE companies  
SET training_budget = training_budget+(training_budget * 0.17867865);

describe companies


select training_budget from companies;

select ceil(training_budget),floor(training_budget),trunc(training_budget,1) from companies;

select ceil(training_budget),floor(training_budget),trunc(training_budget,1),round(training_budget,2)from companies;

