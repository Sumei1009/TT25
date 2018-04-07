DROP FUNCTION bid_status(boolean);
CREATE OR REPLACE FUNCTION bid_status(val BOOLEAN) 
RETURNS VARCHAR(9) AS $$
BEGIN
    IF val is NULL THEN
        RETURN "Pending";
    ELSEIF val THEN
        RETURN "Successful";
    ELSE
    	RETURN "Failed";
    END IF;
END; $$
LANGUAGE PLPGSQL;