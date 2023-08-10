<?php

namespace Scanfully\API;

abstract class Request {

	public function send( string $endpoint, array $data ): void {

		// headers for the requests
		$headers = [
			'Content-Type' => 'application/json',
		];

		// add auth if needed
		$auth_headers = $this->get_auth_headers();
		if ( ! empty( $auth_headers ) ) {
			$headers = array_merge( $headers, $auth_headers );
			error_log(print_r($headers, true),0);
		}

		// request arguments for the requests
		$request_args = [
			'headers'     => $headers,
			'timeout'     => 60,
			'blocking'    => false,
			'httpversion' => '1.0',
			'sslverify'   => false,
		];

		// add body to request if there's any
		$request_body = $this->get_body( $data );
		if ( ! empty( $request_body ) ) {
			$request_args['body'] = json_encode( $request_body );
		}

		error_log(print_r($request_args,true),0);

		$response = wp_remote_post( $this->get_url( $endpoint ), $request_args );

		if ( is_wp_error( $response ) ) {
			// TODO: handle error
			error_log( "Error sending request: " . $response->get_error_message() );
		}

		error_log( "response: " . print_r( $response, true ) );

		// TODO: handle response
	}

	abstract protected function get_auth_headers(): array;

	abstract protected function get_url( string $endpoint ): string;

	abstract protected function get_body( array $data ): array;

}