
# Select 90388714's bid to 'AA00000001'
begin;
update ride_generate
set passenger_id = 90388714
where rid_number = 'AA00000001';

update bid
set status = TRUE
where rid_number = 'AA00000001'
and phone_number = 90388714;


update bid
where rid_number = 'AA00000001'
and phone_number <> 90388714;

commit;
