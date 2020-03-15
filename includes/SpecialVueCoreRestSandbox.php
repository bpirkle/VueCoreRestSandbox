<?php
/**
 * VueCoreRestSandbox Special page.
 *
 * @file
 */

namespace MediaWiki\Extension\VueCoreRestSandbox;

class SpecialVueCoreRestSandbox extends \SpecialPage {

	/**
	 * Initialize the special page.
	 */
	public function __construct() {
		// A special page should at least have a name.
		// We do this by calling the parent class (the SpecialPage class)
		// constructor method with the name as first and only parameter.
		parent::__construct( 'VueCoreRestSandbox' );
	}

	/**
	 * Shows the page to the user.
	 * @param string $sub The subpage string argument (if any).
	 *  [[Special:HelloWorld/subpage]].
	 */
	public function execute( $sub ) {
		global $IP;

		// This loads only routes from core itself, and not from extensions.
		// As this is a toy extension, it includes no error checking.
		$routes = json_decode( file_get_contents( "$IP/includes/Rest/coreRoutes.json" ), true );
		$paths = [];
		foreach ( $routes as $route ) {
			$paths[] = $route['path'];
		}
		$corePaths = json_encode( $paths );

		$out = $this->getOutput();

		$scriptPath = $this->getConfig()->get( 'ScriptPath' ) ?: '/';

        $markup = <<<EOM
		<script type=""text/JavaScript">
			var corePaths = $corePaths;
			var scriptPath = '$scriptPath';
		</script>
        <div id="vue-root">
            <p>This message will disappear once Vue.js initializes.</p>
        </div>
EOM;

		$out->setPageTitle( $this->msg( 'vuecorerestsandbox' ) );
		$out->addSubtitle( $this->msg( 'vuecorerestsandbox-summary' ) );
        $out->addHTML( $markup );
        $out->addModules( 'ext.vueCoreRestSandbox' );
	}

	protected function getGroupName() {
		return 'other';
	}
}
