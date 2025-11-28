pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/username/ci-cd-jenkins.git'
            }
        }

        stage('Build') {
            steps {
                echo 'Build project berjalan...'
            }
        }

        stage('Test') {
            steps {
                echo 'Testing project...'
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploy ke server...'
            }
        }
    }
}