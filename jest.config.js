/**jest.config.js**/
module.exports = {
    testRegex: 'resources/js/test/.*.test.js$',
    collectCoverage: true,
    collectCoverageFrom: ['./resources/js/**/*.{js,jsx}'],
    coverageDirectory: 'coverage',
    testEnvironment: 'jsdom',
    "automock": false,
    "setupFiles": [
      "./setupJest.js"
    ]
  }