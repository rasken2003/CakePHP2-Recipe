<?php
App::uses('CakeEmail', 'Network/Email');

class AppError {
	public static function handleError($code, $description, $file = null, $line = null, $context = null) {
		list($name, $level) = ErrorHandler::mapErrorCode($code);

		$message = sprintf("Desc: %s: %s\n", $name, $description);
		$message .= sprintf("File: %s\n", $file);
		$message .= sprintf("Line: %s\n", $line);
		$message .= "\n";
		$message .= print_r($context, true);

		$email = new CakeEmail('default');
		$email->to('kotobukijisan2003@gmail.com');
		$email->subject('CakePHP ERROR');
		$email->send($message);

		return ErrorHandler::handleError($code, $description, $file, $line, $context);
	}
}
