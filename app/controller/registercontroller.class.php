<?php

/**
 * Handle registration process requests.
 * @author anza
 * @version 03-04-2011
 */
class RegisterController extends AbstractController implements RequestContext
{
	/**
	 * @Invocable
	 */
	protected function index()
	{
		$this->setAction('register');
	}

	/**
	 * Validate form data and register new user.
	 * @Invocable
	 */
	protected function register()
	{
		try
		{
			$fo = FOFactory::build('register');
			if (!$fo->isSent())
				return;
			$this->model->register($fo);
			$this->request->success = Bundle::get('form.validation.field.register.success');
		}
		catch (FormValidationException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.invalid.value', $e->getMessage());
		}
		catch (DuplicateException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.login.taken', $e->getField());
		}
	}
}

?>