#include<cstdio>
#include<stack>
#include<queue>
#include<cstring>
using namespace std;

int main()
{
    int n;
    char a[11],b[11];
    stack <char> s;
    queue <int> q;
    memset(a,0,sizeof(a));
    memset(b,0,sizeof(b));
    while(scanf("%d",&n)!=EOF)
    {
        int i=0,j=0;
        while(!s.empty())
            s.pop();//s.clear();X error: 'class std::stack<char>' has no member named 'clear'
        while(!q.empty())
            q.pop();//q.clear();X error: 'class std::queue<char>' has no member named 'clear'|
        scanf("%s",a);
        scanf("%s",b);
        while(i<n)
        {
            s.push(a[i]);
            q.push(1);
            while(!s.empty()&&s.top()==b[j])
            {
                s.pop();
                q.push(0);
                j++;
            }
            i++;
        }
        if(s.empty())
        {
            printf("Yes.\n");
            while(!q.empty())
            {
                if(q.front())
                    printf("in\n");
                else
                    printf("out\n");
                q.pop();
            }
        }
        else
            printf("No.\n");
        printf("FINISH\n");
    }
    return 0;
}
