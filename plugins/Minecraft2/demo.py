#!/usr/bin/python
import mcquery
import sys
import json

host = sys.argv[1]
port = int(sys.argv[2])

q = mcquery.MCQuery(host, port)
print json.dumps(q.full_stat())
