
-- Select 90388714's bid to 'AA00000003'
begin;
update ride_generate
set passenger_id = 90388714
where rid_number = 'AA00000003';

update bid
set status = TRUE
where rid_number = 'AA00000003'
and phone_number = 90388714;


update bid
set status = FALSE
where rid_number = 'AA00000003'
and phone_number <> 90388714;

commit;
