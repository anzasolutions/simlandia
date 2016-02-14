<?php

/**
 * Handle authentication requests.
 * @author anza
 * @version 30-09-2010
 */
class AuthController extends AbstractController implements RequestContext
{
//	private $logger;
	
//	public function __construct()
//	{
//		parent::__construct();
//		$this->logger = Logger::getLogger(__CLASS__);
//	}
	
	/**
	 * @Invocable
	 */
	protected function index()
	{
		$this->setAction('login');
	}
	
	/**
	 * Login user and start session.
	 * @Invocable
	 */
	protected function login()
	{
		try
		{
			$fo = FOFactory::build('login');
			if (!$fo->isSent())
				return;
			$user = $this->model->login($fo);
			$this->startSession($user);
		}
		catch (FormNotFoundException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.processing.problem');
		}
		catch (FormValidationException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.invalid.value', $e->getMessage());
		}
		catch (NoResultException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('auth.message.invalid.user');
		}
	}
	
	/**
	 * Start session for logged in user.
	 * @param object $user
	 */
	private function startSession(User $user)
	{
		if ($this->request->hasKey('remember'))
		{
			Session::getInstance()->setRemembered(TRUE);
		}
		Session::getInstance()->start();
		Session::set('user', $user);
		Navigator::redirectTo();
	}
	
	/**
	 * Create new password and send to User's email.
	 * @Invocable
	 */
	public function recover()
	{
		try
		{
			$fo = FOFactory::build('recover');
			if (!$fo->isSent())
				return;
			$this->model->recover($fo);
			$this->request->success = Bundle::get('recover.message.success.password.sent');
		}
		catch (FormNotFoundException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.processing.problem');
		}
		catch (FormValidationException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.invalid.value', $e->getMessage());
		}
		catch (NoResultException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('recover.message.error.invalid.email', $fo->getEmail());
		}
	}
	
	/**
	 * Activate existing User.
	 * @Invocable
	 */
	public function activate()
	{
		try
		{
			$activeHash = $this->validateActiveHash();
			$this->model->activate($activeHash);
			$this->request->success = Bundle::get('form.validation.field.register.activated');
		}
		catch (NoResultException $e)
		{
			$e->getTraceAsString();
			Navigator::redirectTo($this);
		}
	}
	
	/**
	 * Check activation hash exists.
	 * @return string Activation hash.
	 */
	private function validateActiveHash()
	{
		$activeHash = $this->url->getParameter(0);
		if ($activeHash == null)
		{
			$this->redirectToError();
		}
		return $activeHash;
	}
}

?>