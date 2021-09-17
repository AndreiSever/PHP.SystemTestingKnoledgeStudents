all: crudable.js

crudable.js: crudable.es6.js babelrc
	babel crudable.es6.js > crudable.js

clean:
	rm -f crudable.js

babelrc: .babelrc
