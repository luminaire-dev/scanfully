<?php
namespace Scanfully\Connect;

class DisconnectButton {

	/**
	 * Generate the URL for the connect button.
	 *
	 * @return string
	 */
	private function generate_url(): string {
		return add_query_arg( [
			'page'                    => 'scanfully',
			'scanfully-disconnect'       => 1,
			'scanfully-disconnect-nonce' => wp_create_nonce( 'scanfully-disconnect-redirect' )
		], admin_url( 'options-general.php' ) );
	}

	/**
	 * Render the button.
	 *
	 * @return void
	 */
	public function render(): void {
		?>
		<a href="<?php esc_attr_e( $this->generate_url() ); ?>" class="scanfully-connect-button scanfully-connect-button-disconnect">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.30061 2.30695C6.68334 2.14856 7.12201 2.33042 7.2804 2.71316L8.19302 4.91836C8.35141 5.3011 8.16954 5.73977 7.78681 5.89816C7.40408 6.05655 6.96541 5.87469 6.80702 5.49195L5.8944 3.28675C5.73601 2.90401 5.91787 2.46534 6.30061 2.30695Z" fill="currentColor"/>
				<path d="M19.6879 4.15773C16.9672 1.61403 12.5756 1.61403 9.85484 4.15773L9.48781 4.50087C9.18524 4.78376 9.16928 5.25836 9.45216 5.56093C9.73505 5.8635 10.2097 5.87946 10.5122 5.59658L10.8792 5.25343C13.0234 3.24879 16.5193 3.24879 18.6635 5.25343C20.7789 7.23118 20.7789 10.4155 18.6635 12.3932L16.4613 14.4521C16.1587 14.735 16.1428 15.2096 16.4257 15.5122C16.7086 15.8147 17.1832 15.8307 17.4857 15.5478L19.6879 13.4889C22.4374 10.9183 22.4374 6.72832 19.6879 4.15773Z" fill="currentColor"/>
				<path d="M6.17183 10.5347C6.46716 10.2443 6.47114 9.76941 6.18071 9.47408C5.89027 9.17874 5.41542 9.17477 5.12008 9.4652L4.21509 10.3552C1.54336 12.9826 1.61504 17.2093 4.31376 19.79C7.02135 22.3792 11.4361 22.4173 14.1529 19.8193L14.5184 19.4698C14.8177 19.1836 14.8283 18.7088 14.5421 18.4094C14.2558 18.1101 13.781 18.0995 13.4817 18.3857L13.1162 18.7352C10.9885 20.7699 7.48737 20.7494 5.35045 18.7059C3.25251 16.6997 3.20945 13.4479 5.26684 11.4247L6.17183 10.5347Z" fill="currentColor"/>
				<path d="M3.83138 5.41254C3.45914 5.23084 3.01009 5.38531 2.8284 5.75755C2.64671 6.12979 2.80117 6.57884 3.17341 6.76053L8.72125 9.46848C9.09348 9.65017 9.54253 9.4957 9.72422 9.12347C9.90592 8.75123 9.75145 8.30218 9.37921 8.12049L3.83138 5.41254Z" fill="currentColor"/>
			</svg>
			<span><?php esc_html_e( 'Disconnect your Scanfully account', 'scanfully' ); ?></span>
		</a>
		<?php
	}
}