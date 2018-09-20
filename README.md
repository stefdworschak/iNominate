# iNominate

##Git Instructions

### Getting Started

To set up the git directory on your workstation follow these instructions:

1) Open a new Explorer Window
2) Right click and select "Git Bash here"
3) Copy or write the below line in the command window

```
git clone https://github.com/stefdworschak/iNominate.git
```

### Creating your own development branch

To check existing branches
```
git branch -a
```
To create your own branch (this should be a unique name)
```
git branch new_branch_name
```
To move to your new branch (same works for master)
```
git checkout new_branch_name
```

### Every time before starting to work

Before you start working on any new code pull the newest version of the master file

```
git pull origin master
```
