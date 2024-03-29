protected function executeQuery($sql)
{
    $result = $this->connect()->query($sql);

    $results_array = array();

    // check results type
    if(is_bool($result))
    {
        // if results type is boolean, check value and return either 1 or 0, True/False
        if ($result === TRUE)
        {
            $results_array['results'] = 1;
        }
        else
        {
            $results_array['results'] = 0;
        }

    }
    elseif (is_object($result))
    {
        // if results type is an object, check the number of rows.
        if ($result->num_rows > 0)
        {
            // if rows creater than 0, fetch associative array of the row and add to array
            while ($row = $result->fetch_assoc())
            {
                $results_array['results'] = $row;
            }
        }
        else
        {
            // else return 0 for fail
            $results_array['results'] = 0;
        }

    }
    else
    {
        $results_array['results'] = 0;
    }

    // close the connection
    $this->close();

    return $results_array;
}
