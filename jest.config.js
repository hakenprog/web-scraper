/**jest.config.js**/
module.exports = {
    testRegex: 'resources/js/test/.*.test.js$',
    collectCoverage: true,
    collectCoverageFrom: ['src/**/*.{js,jsx}'],
    coverageDirectory: 'coverage',
    testEnvironment: 'jsdom',
  }