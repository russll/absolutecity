<?php
/**
 * Creates a generic exception.
 */
class IzExcept extends Exception
{
    /**
     * Set exception message.
     *
     * @param  string  language key for the message
     * @param  array   addition line parameters
     */
    public function __construct($error)
    {
        $args = array_slice(func_get_args(), 1);

        $message = '';
        // Fetch the error message
        if (!empty($args))
        {
            $message .= ' '.print_r($args, 1);
        }

        if ($message === $error OR empty($message))
        {
            // Unable to locate the message for the error
            $message = 'Unknown Exception: '.$error;
        }

        // Sets $this->message the proper way
        parent::__construct($message);
    }



    /**
     * Magic method for converting an object to a string.
     *
     * @return  string  message
     */
    public function __toString()
    {
        return (string) $this->message;
    }

    
    /**
     * Sends an Internal Server Error header.
     *
     * @return  void
     */
    public function sendHeaders()
    {
        // Send the 500 header
        header('HTTP/1.1 500 Internal Server Error');
    }

} // End Iz Exception
?>