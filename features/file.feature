Feature: Upload a file

  Scenario: Invalid request
    When I send a "POST" request to "api/file" with parameters:
      | key       | value       |
      | file      | @test.php   |
    Then the response status code should be 400

  Scenario: Valid request
    When I send a "POST" request to "api/file" with parameters:
      | key             | value       |
      | attachment      | @test.php   |
    Then the response status code should be 201