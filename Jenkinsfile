pipeline {
  agent {
    node {
      label 'test'
    }
    
  }
  stages {
    stage('Build') {
      steps {
        sh 'git clone https://github.com/cafemedia/feature'
      }
    }
    stage('composer_install') {
      steps {
        sh 'composer install'
      }
    }
    stage('php_lint') {
      steps {
        sh 'find . -name "*.php" -print0 | xargs -0 -n1 php -l'
      }
    }
    stage('phpunit') {
      steps {
        sh 'phpunit'
      }
    }
    stage('cleanup') {
      steps {
        deleteDir()
      }
    }
  }
}